@include('partials.header');
    <div class="container">
        <h1> create classrooms</h1>
        <form action="{{ route("calssrooms.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Class Name">
                <label for="name">Class Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="section" name="section" placeholder="Section">
                <label for="section">Section</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                <label for="subject">Subject</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="room" name="room" placeholder="Room">
                <label for="room">Room</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control" id="cover_image" name="cover_image"
                    placeholder="Cover Image">
                <label for="cover-image">Cover Image</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Room</button>
        </form>
    </div>
@include('partials.footer')
