@extends('layouts.master')
@section('content')
@section('title', 'Topics')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush

{{-- <p> Welcome {{ $name }} , {{ $title  }} </p>
    <a href="{{ route('classroom.topic.show',['edit' => 1 ,'id' => 56], false)}}" >Create</a>
    <a href="{{ route(name: 'classroom.topic.create', absolute:false)}}" >Create</a> --}}
@section('content')
@if(session()->has('success'))
    
<div class="alert alert-success">{{ $success }}</div>
@endif
    @foreach ($topics as $topic)
        <div class="row m-4">

            <div class="alert alert-light border-success" role="alert">
                <h4 class="alert-heading">{{ $topic->name }}</h4>
                <p>Topic of {{ $topic->classroom_name }}</p>
                <hr style="height: 2px;
                background-color: #ff0000; /* Set your desired color */
                background-image: linear-gradient(to right, #ff0000, #00ff00); /* Set your desired gradient */
             ">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('classroom.topic.show',['classroom'=>$classroom,'topic'=>$topic->id]) }}" class="btn btn-sm btn-primary">View</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('classroom.topic.edit', ['classroom'=>$classroom,'topic'=>$topic->id]) }}" class="btn btn-sm btn-dark">Edit</a>
                    </div>
                    <div class="col">
                        <form action="{{ route('classroom.topic.destroy', ['classroom'=>$classroom,'topic'=>$topic->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
@endpush
