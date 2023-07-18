<div class="card">
    <img class="card-img-top" src="uploads/{{$classroom->cover_image_path}}" alt>
    <div class="card-body">
        <h5 class="card-title"> {{ $classroom->name }}</h5>
        <p class="card-text"> {{ $classroom->section }}- {{ $classroom->room }}</p>
        <div class="row">
            <div class="col">
                <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-sm btn-primary">View</a>
            </div>
            <div class="col">
                <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-sm btn-dark">Edit</a>
            </div>
            <div class="col">
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger ">Delete</button>
                </form>
            </div>
        </div>

    </div>
</div>
