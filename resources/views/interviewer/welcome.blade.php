<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interviewer</title>
    <style>
        body {
          background-image: url({{URL::asset('/image/welcome.jpg')}});
            background-repeat: no-repeat;
             background-attachment: fixed;
            background-size: 100% 100%;
        }
        </style>
</head>
<body>
    @include('interviewer/nav')
</body>
</html>