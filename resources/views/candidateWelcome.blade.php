<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="#" onclick="document.getElementById('logout-form').submit();"> Logout</a>
    <form id="logout-form" action="{{ route('candidate.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <h1>Welcome candidate</h1>
</body>
</html>