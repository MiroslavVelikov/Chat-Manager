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
    <script src="{{ asset('js/logic.js') }}"></script>
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
                            <div>
                                <form action="{{ route('getMessage') }}" method="GET">
                                    @csrf
                                    <div class="friend">
                                        <input type="text" style="display:none" name="friendName"
                                            value="{{ $row }}">
                                        <li>
                                            <button class="friend-name">{{ $row }}</></button>
                                        </li>
                                    </div>
                                </form>
                            </div>
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
                    @if (!empty($friendName))
                        <h2 id="message-to">{{ $friendName }}</h2>
                    @endif
                </div>
            </div>
            <div class="messages">
                @if (!empty($messages))
                    @foreach ($messages as $row)
                        @if ($row['user'] == 'me')
                            <div class="my-chat">{{ $row['message'] }}</div>
                        @endif
                        @if ($row['user'] == 'him')
                            <div class="friend-chat">{{ $row['message'] }}</div>
                        @endif
                    @endforeach
                @endif
                {{-- @if (!empty($myMessages))
                    @foreach ($myMessages as $row)
                        <div class="my-chat">{{ $row }}</div>
                    @endforeach
                @endif
                @if (!empty($frMessages))
                    @foreach ($frMessages as $row)
                        <div class="friend-chat">{{ $row }}</div>
                    @endforeach
                @endif --}}
            </div>
            <form action="{{ route('postMessage') }}" method="POST">
                @csrf
                <div class="send-message">
                    @if (!empty($friendName))
                        <input type="text" style="display:none" name="friendName" value="{{ $friendName }}">
                    @endif
                    <input type="text" required id="ip1" name="chat_message">
                    <button class="send"><i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
