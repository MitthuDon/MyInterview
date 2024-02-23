

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Lost</title>
</head>
<body>
 

    <style>
        body {
          background-image: url({{URL::asset('/image/lost.jpg')}});
            background-repeat: no-repeat;
             background-attachment: fixed;
            background-size: 100% 100%;
        }
        </style>
<div>
  
@if ( $nav != null && $nav == 'candidate')
@include('nav')
@elseif($nav == 'interviewer')
@include('interviewer/nav') 
@endif
</div>

</body>
</html>