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
    <title>Chat</title>
</head>




<body>
    <div class="login-box">
        <div class="login-user">
            <div class="login-user">
                <img src="./images/user_icon.png" alt="login-user">
            </div>
        </div>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="center">
                <p id="userName" name="userName">{{ $userName }}</p>
            </div>
            <div class="center">
                {{-- <input type="text" id="userName" name="userName" value="{{ $userName }}" /> --}}
                <input style="display:none" type="text" id="userName" name="userName" value="{{ $userName }}" />
                <button class="button button1">CONTINUE</button>
            </div>
        </form>
    </div>
</body>

</html>
