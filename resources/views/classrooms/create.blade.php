@include('partials.header')
    <div class="container">
        <h1> create classrooms</h1>
        <form action="{{ route("calssrooms.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('classrooms._form',[
                'button_label' => 'Create Classroom'
            ])
            </form>
    </div>
@include('partials.footer')
