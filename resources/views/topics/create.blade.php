@include('partials.header');
    <div class="container">
        <h1> create classrooms</h1>
        <form action="{{ route("topics.store") }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Topic Name">
                <label for="name">Topic Name</label>
            </div>
            <div class="form-floating mb-3">
                <label for="classroom_id"></label>
                <select name="classroom_id" id="classroom_id" class="form-control">
                    <option value=""></option>
                    @foreach ($classrooms as $classroom )
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
           
            <button type="submit" class="btn btn-primary">Create Topic</button>
        </form>
    </div>
@include('partials.footer')
