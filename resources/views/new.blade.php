<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <img src="./images/user_icon.png" alt="user">
                <div class="user-info">
                    <h2 id="my-username">dsdsad</h2>
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
                    <button class="friend-name">Miro</button>
                    <button class="friend-name">Gosho</button>
                    <button class="friend-name">Pesho</button>
                </ul>
            </div>

            <form method="GET">
                <div class="add-friends">
                    <input type="text" placeholder="Add friend" required id="ip2" autocomplete="off">
                    <button class="button button1"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>

        <!-- Chats -->
        <div class="chats">
            <div class="friend">
                <div class="user-info">
                    <h2 id="message-to">v15674dasdasd</h2>
                </div>
                <img src="./images/user_icon.png" alt="user">
            </div>

            <div id="wrapper">
                <div class="scrollbar" id="style-1">
                    <div class="force-overflow">
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                        <div class="my-chat">Hi</div>
                        <div class="friend-chat">Hi</div>
                        <div class="my-chat">Working?</div>
                        <div class="friend-chat">I guess!</div>
                    </div>
                </div>
            </div>

            <form method="SEND">
                <div class="send-message">
                    <button onclick="refresh()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    <input type="text" id="ip1" autocomplete="off">
                    <button class="send"><i class="fa fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
