@include('partials.header');
<div class="container">
    <h1> Edit classrooms</h1>

    
    <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ $classroom->name }}" id="name" name="name"
                placeholder="Class Name">
            <label for="name">Class Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ $classroom->section }}" id="section" name="section"
                placeholder="Section">
            <label for="section">Section</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ $classroom->subject }}" id="subject" name="subject"
                placeholder="Subject">
            <label for="subject">Subject</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ $classroom->room }}" id="room" name="room"
                placeholder="Room">
            <label for="room">Room</label>
        </div>
        <div class="form-floating mb-3">
            <img class="card-img-top-sm" src="{{ asset('uploads/' . $classroom->cover_image_path) }}" alt="">
            <input type="file" class="form-control" id="cover_image" name="cover_image" placeholder="Cover Image">
            <label for="cover-image">Cover Image</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Classroom</button>
    </form>
</div>
@include('partials.footer')
