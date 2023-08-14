@include('partials.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>topics</title>
</head>
<body>
    <div class="container">
    <h3> Topic :{{ $topic->name }} of classroom :{{ $classroom->name }}</h3>

   
 </div>
 @include('partials.footer')
