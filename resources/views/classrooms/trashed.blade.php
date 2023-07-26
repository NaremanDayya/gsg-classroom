@extends('layouts.master')
@section('content')
@section('title','Trashed Classrooms')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush
{{-- <p> Welcome {{ $name }} , {{ $title  }} </p>
    <a href="{{ route('classrooms.show',['edit' => 1 ,'id' => 56], false)}}" >Create</a>
    <a href="{{ route(name: 'classrooms.create', absolute:false)}}" >Create</a> --}}
<x-form.alert name="success"></x-form.alert>
<div class="container">
{{-- <x-alert name="success" /> --}}
    <div class="row">
    
    @foreach ($classrooms as $classroom)
        {{-- حجزنا 3 اعمدة * 4صفوف يعني 12   --}}
        <div class="col-md-3">
           <x-form.card :classroom="$classroom">
            
            <div >
                <form action="{{ route('classrooms.restore', $classroom->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-danger ">Restore</button>
                </form>
            </div>
             <div >
                <form action="{{ route('classrooms.force-delete', $classroom->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger ">Delete Forever</button>
                </form>
            </div>
           </x-form.card>
        </div>
    @endforeach
</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
{{-- <script>console.log('@@stack')</script>رح يطبع بالكونسول @stack  --}}
@endpush
{{-- @pushIf('true','script')
 <script>console.log('@@stack')</script>رح يطبع بالكونسول @stack  
@endpushIf --}}