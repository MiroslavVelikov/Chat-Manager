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
                <div class="delete">
                    <button id="btnDelete" onclick="confirmPromp()"><i class="fa fa-trash"></i></button>
                </div>
                <!-- The Modal For Deleting -->
                <div id="deleteModal" class="modal">
                    <!-- Modal content /deleting/ -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h1 class="modal-text">Deleting account</h1>
                        <h2 class="modal-text">By doing this, you agree to delete all your chats and user connections.
                        </h2>
                        <button class="btn-agree" onclick="deleteUser()">Agree</button>
                    </div>
                </div>
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
                                    <input type="text" style="display:none" name="friendName"
                                        value="{{ $row }}">
                                    <button class="friend-name">{{ $row }}</></button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </ul>
            </div>

            <form action="{{ route('add-frind') }}" method="POST">
                @csrf
                <div class="add-friends">
                    <input type="text" placeholder="Find friend" required id="ip2" name="friendName" autocomplete="off">
                    <button class="button button1"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>
        <script>
            confirmPromp();
        </script>
        <!-- Chats -->
        <div class="chats">
            <div class="friend">
                <div class="user-info">
                    @if (!empty($friendName))
                        <h2 id="message-to">{{ $friendName }}</h2>
                    @endif
                </div>
                <img src="./images/user_icon.png" alt="user">
            </div>
            {{-- sadasdasddasda --}}
            <div id="wrapper">
                <div class="scrollbar" id="style-1">
                    <div class="force-overflow">
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
                        <script>
                            var element = document.getElementById("style-1");
                            element.scrollTop = element.scrollHeight - 1;
                        </script>
                    </div>
                </div>
            </div>

            {{-- asdasdasdasd --}}

            <form action="{{ route('postMessage') }}" method="POST">
                @csrf
                <div class="send-message">
                    @if (!empty($friendName))
                        <input type="text" style="display:none" name="friendName" value="{{ $friendName }}">
                    @endif
                    <label onclick="refresh()"><i class="fa fa-refresh" aria-hidden="true"></i></label>
                    <input type="text" required id="ip1" name="chat_message" autocomplete="off">
                    <button class="send"><i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
