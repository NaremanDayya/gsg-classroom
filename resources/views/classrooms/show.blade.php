@include('partials.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classrooms</title>
</head>
<body>
    <div class="container">
    <h1> Classrooms Details: {{ $classroom->name }}  (# {{ $classroom->id}})</h1>
    <h3>{{ $classroom->section }}</h3>

    <div class="row">
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">
                <span class="text-success fs-2">{{ $classroom->code}}</span>
            </div>
        </div>
        <div class="col-md-9">

        </div>
    </div>
 </div>
 @include('partials.footer')
