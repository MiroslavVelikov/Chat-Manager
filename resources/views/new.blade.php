@section('ds')
@stop
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="style.css">
    <script src="logic.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <title>Chat</title>
</head>

<body>
    <div class="chat-box">
        <!-- Friends -->
        <div class="friends">
            <div class="user">
                <img src="{{ asset('./images/user_icon.png') }}" alt="user">
                <div class="user-info">
                    <h2 id="my-username">{{ Sentinel::getUser()['first_name'] }} </h2>
                </div>
                <form action="{{ route('logout') }}" method="GET">
                    <div class="user-remove">
                        {{-- <input style="display:none" type="text" id="userName" name="userName"
                            value="{{ $userName }}" /> --}}
                        <button class="delete"><i class="fa fa-trash"></i></button>
                    </div>
                </form>
            </div>
            <div class="friends-list">
                <label id="no-friends">Looks like you have not added any friends yet. Invite friends to chat
                    with!</label>
                <ul class="list">
                    @if (!empty($table))
                        @foreach ($table as $row)
                            <li>
                                {{ $row }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <form action="{{ route('add-frind') }}" method="POST">
                @csrf
                <div class="add-friends">
                    <input type="text" placeholder="Find friends" required id="ip2" name="friendName">
                    <button class="button button1"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>

        <!-- Chats -->
        <div class="chats">
            <div class="message-to">
                <img src="./images/user_icon.png" alt="user">
                <div class="user-info">
                    <h2 id="message-to">Username</h2>
                </div>
            </div>
            <div class="messages">
                <div class="my-chat">Hi</div>
                <div class="friend-chat">Hi</div>
                <div class="my-chat">Working?</div>
                <div class="friend-chat">I guess!</div>
            </div>
            <form method="POST">
                <div class="send-message">
                    <input type="text" required id="ip1">
                    <button class="send"><i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
