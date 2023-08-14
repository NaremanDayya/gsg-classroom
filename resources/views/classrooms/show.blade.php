@include('partials.header')

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
            <p>Invitation Link:<a href="{{ $classroom->invitation_link }}"> {{ $classroom->invitation_link }}</a></p>

        <p> <a class="btn btn-outline-dark" href="{{ route('classroom.classwork.index', $classroom->id) }}">classworks</a></p>        
    </div>
</div>
 </div>
 @include('partials.footer')
