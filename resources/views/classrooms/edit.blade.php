@include('partials.header');
<div class="container">
    <h1> Edit classrooms</h1>

    
    <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('classrooms._form',[
            'button_label' => 'Edit Classroom'
        ])
    </form>
</div>
@include('partials.footer')