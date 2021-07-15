<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
/* use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; */


use Activation;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SubscriptionRequest;
use App\User;
use App\Page;
use Gloudemans\Shoppingcart\Cart;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Lang;
use Mail;
use Redirect;
use Reminder;
use Sentinel;
use URL;
use View;
use Validator;
use App;
use App\Sale;
use App\SaleItem;
use Facade\FlareClient\View as FlareClientView;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class FrontEndController extends Controller
{
    public function getHome(Request $request)
    {
        // Is the user logged in?
        if (Sentinel::check()) {

            $table = $this->loadFriends();
            if (isset($table)) {
                return View::make('index', compact('table'));
            }

            return View::make('index');
        }

        // Show the login page
        return Redirect::to('login');
    }

    public function loadFriends()
    {
        $userID = Sentinel::getUser()['id'];

        $friends = \DB::table('users_connections')->where('c_user_id', $userID)->get();

        $table = array();
        if ($friends != null) {
            foreach ($friends as $friend) {
                $table[] = \DB::table('users')->where('id', $friend->o_role_id)->first()->first_name;
            }

            return $table;
        }

        return null;
    }

    public function getLogin(Request $request)
    {
        if (Sentinel::check()) {
            return Redirect::back();
        }

        $charPart = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 1);
        $intPart = (string) rand(1, 9);
        $intPart2 = (string) rand(1, 9);
        $intPart3 = (string) rand(1, 9);

        $userName = $charPart . $intPart . $intPart2 . $intPart3;

        if (\DB::table('users')->where('first_name', $request->$userName)->exists()) {
            return $this->getLogin($request);
        }

        return View::make('login', compact(array('userName')));
    }

    public function getLogout(Request $request)
    {
        $userID = Sentinel::getUser()['id'];
        $chats =  \DB::table('chats')->get();

        if ($chats != null) {
            foreach ($chats as $connection) {
                $users = explode('_', $connection->users_connections);

                if ($users[0] == $userID) {
                    if (\DB::table('chats')->where('users_connections',  $connection->users_connections)->first() != null) {
                        \DB::table('chats')->where('users_connections',  $connection->users_connections)->delete();
                    }
                    if (\DB::table('chats')->where('users_connections',  strrev($connection->users_connections))->first() != null) {
                        \DB::table('chats')->where('users_connections', strrev($connection->users_connections))->delete();
                    }
                } elseif ($users[1] == $userID) {
                    if (\DB::table('chats')->where('users_connections',  $connection->users_connections)->first() != null) {
                        \DB::table('chats')->where('users_connections',  $connection->users_connections)->delete();
                    }
                    if (\DB::table('chats')->where('users_connections',  strrev($connection->users_connections))->first() != null) {
                        \DB::table('chats')->where('users_connections', strrev($connection->users_connections))->delete();
                    }
                }
            }
        }

        Sentinel::logout();

        \DB::table('users')->where('id', $userID)->delete();
        \DB::table('users_connections')->where('c_user_id', $userID)->delete();
        \DB::table('users_connections')->where('o_role_id', $userID)->delete();

        return Redirect::to('/');
    }


    public function postRegister(Request $request)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $userName = $request->userName;
        $hashed_random_password = Hash::make(substr(str_shuffle(str_repeat($pool, 5)), 0, 8));

        $user = Sentinel::register(array(
            'first_name'    => $userName,
            'email'    => $userName . '@chat.bg',
            'password' => $hashed_random_password,
        ), true);

        if (\DB::table('users')->where('first_name', $request->$userName)->exists()) {
            return Redirect::to('/');
        }

        Sentinel::login($user, true);

        return Redirect::to('/');
    }


    public function postAddFriend(Request $request)
    {
        $currentUserId = Sentinel::getUser()['id'];

        if (\DB::table('users')->where('first_name', $request->friendName)->first() == null) {
            return Redirect::to('/');
        }

        $friendId = \DB::table('users')->where('first_name', $request->friendName)->first()->id;

        $isThere = \DB::table('users_connections')->where('o_role_id', $friendId)->first();

        if ($isThere == null) {
            $id = DB::table('users_connections')->insertGetId(
                [
                    'c_user_id' => $currentUserId,
                    'o_role_id' => $friendId
                ]
            );
            $id2 = DB::table('users_connections')->insertGetId(
                [
                    'c_user_id' => $friendId,
                    'o_role_id' => $currentUserId
                ]
            );
        }

        return Redirect::to('/');
    }

    public function getMessage(Request $request)
    {
        $table = $this->loadFriends();

        $currentUserId = Sentinel::getUser()['id'];
        $friendName = $request['friendName'];
        $friendID = \DB::table('users')->where('first_name', $friendName)->first()->id;


        $connectonTypeOne = $currentUserId . '_' . $friendID;
        $connectonTypeTwo = $friendID . '_' . $currentUserId;

        $messages = array();

        if (
            isset(\DB::table('chats')->where('users_connections', $connectonTypeOne)->first()->message)
            || isset(\DB::table('chats')->where('users_connections', $connectonTypeTwo)->first()->message)
        ) {
            foreach (\DB::table('chats')->where('users_connections', $connectonTypeOne)
                ->orWhere('users_connections', $connectonTypeTwo)->orderBy('created_at', 'asc')->get() as $message) {
                $from = '';
                if ($message->users_connections == $connectonTypeOne) {
                    $from = 'me';
                } else {
                    $from = 'him';
                }
                $messages[] = ['user' => $from, 'message' => $message->message];
            }
        }

        return View::make('index', compact('table', 'messages', 'friendName'));
    }

    public function postMessage(Request $request)
    {
        $currentUserId = Sentinel::getUser()['id'];

        if (\DB::table('users')->where('first_name', $request->friendName)->first() == null) {
            return Redirect::to('/');
        }

        $friendID = \DB::table('users')->where('first_name', $request->friendName)->first()->id;

        $connectonTypeOne = $currentUserId . '_' . $friendID;

        if (isset($request->chat_message)) {
            $current_timestamp = Carbon::now();

            $id = DB::table('chats')->insertGetId(
                [
                    'users_connections' => $connectonTypeOne,
                    'message' => $request->chat_message,
                    'created_at' => $current_timestamp,
                    'updated_at' => $current_timestamp
                ]
            );
        }
        return redirect()->back();
    }
}
