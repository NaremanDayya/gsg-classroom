@extends('layouts.master')
@section('content')
@section('title','Trashed Topics')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush
{{-- <p> Welcome {{ $name }} , {{ $title  }} </p>
    <a href="{{ route('topics.show',['edit' => 1 ,'id' => 56], false)}}" >Create</a>
    <a href="{{ route(name: 'topics.create', absolute:false)}}" >Create</a> --}}
<x-form.alert name="success"></x-form.alert>
{{-- <x-alert name="success" /> --}}
    <div class="row">
    
    @foreach ($topics as $topic)
        {{-- حجزنا 3 اعمدة * 4صفوف يعني 12   --}}
        <div class="col-md-3">
            <div class="card-body ">
                <h5 class="card-title"> {{ $topic->name }}</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('classroom.topic.show', ['classroom'=>$classroom,'topic'=>$topic->id]) }}" class="btn btn-sm btn-primary">View</a>
                    <div class="col">
                        <form action="{{ route('topics.restore', $topic->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-danger ">Restore</button>
                        </form>
                    </div>
                     <div class="col">
                        <form action="{{ route('topics.force-delete', $topic->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger ">Delete Forever</button>
                        </form>
                    </div>                </div>
        
            </div>
           
        </div>
    @endforeach
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
{{-- <script>console.log('@@stack')</script>رح يطبع بالكونسول @stack  --}}
@endpush
{{-- @pushIf('true','script')
 <script>console.log('@@stack')</script>رح يطبع بالكونسول @stack  
@endpushIf --}}