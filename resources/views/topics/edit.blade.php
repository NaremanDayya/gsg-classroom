@include('partials.header');
<div class="container">
    <h1> Edit topicss</h1>
    <form action="{{ route('classroom.topic.update', $topic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" value="{{ $topic->name }}" id="name" name="name"
                placeholder="Class Name">
            <label for="name"> Topic Name</label>
        </div>
        {{-- <div class="form-floating mb-3">
            <select name="classroom_id" id="classroom_id" class="form-control">
                <option value="{{ $topic->classroom_id }}">{{ $topic->classroom_name }}</option>
                @foreach ($classrooms as $classroom)
                    @if ($topic->classroom_id != $classroom->id)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endif
                @endforeach
            </select>
        </div> --}}

        <button type="submit" class="btn btn-primary">Update Topics</button>
    </form>
</div>
@include('partials.footer')
