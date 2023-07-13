@extends('layouts.master')
@section('content')
@section('title','Topics')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@endpush

{{-- <p> Welcome {{ $name }} , {{ $title  }} </p>
    <a href="{{ route('topics.show',['edit' => 1 ,'id' => 56], false)}}" >Create</a>
    <a href="{{ route(name: 'topics.create', absolute:false)}}" >Create</a> --}}
@section('content')
<div class="row">
    
    @foreach ($topics as $topic)
        {{-- حجزنا 3 اعمدة * 4صفوف يعني 12   --}}
        <div class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1894cf19121%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1894cf19121%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.836840629577637%22%20y%3D%2216.960000014305116%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                @for
                Topic of  {{ $topic->classroom_id }}
              <strong class="d-block text-gray-dark">{{ $topic->name }}</strong>
            </p>
          </div>
        <div class="col-md-3">
            <div class="card" >
                <img class="card-img-top" src="" alt"">
                <div class="card-body">
                    <h5 class="card-title"> {{ $topic->name }}</h5>
                    <p class="card-text">Topic of  {{ $topic->classroom_id }}</p>
                    <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-sm btn-dark">Edit</a>
                    <form action="{{ route('topics.destroy',$topic->id) }} method ='POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endpush