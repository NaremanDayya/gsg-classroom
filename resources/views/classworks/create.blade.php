@include('partials.header')
<div class="container">
    <h1> Create Classwork</h1>
    <hr>
    <form action="{{ route('classroom.classwork.store', ['classroom' => $classroom->id, 'type' => $type]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @include('classworks._form')




        <button type="submit" class="btn btn-primary">Create Classwork</button>
    </form>
</div>
@include('partials.footer')
