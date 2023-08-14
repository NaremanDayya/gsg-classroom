@extends('layouts.master')
@section('content')
@section('title', 'People')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush'
<x-form.alert name="success" class="alert-success"></x-form.alert>
<x-form.alert name="error" class="alert-danger"></x-form.alert>
<div class="container">
    <h1> {{ $classroom->name }} People</h1>
    <h3>{{ $classroom->section }}</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody
            @foreach ($classroom->users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->pivot->role }}</td>
                {{-- <td>{{ $user->join->role }}</td>//لما غيرنا اسم الpivot ل join --}}
                <td>
                    <form action="{{ route('classrooms.people.destroy', $classroom->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-sm btn-danger ">Delete</button>
                    </form>
                </td>
                <td></td>
            </tr>
       
        </tbody> @endforeach
            @endsection @push('scripts') <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>
    @endpush
