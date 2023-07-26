<div class="card">
    <img class="card-img-top" src="uploads/{{$classroom->cover_image_path}}" alt>
    <div class="card-body ">
        <h5 class="card-title"> {{ $classroom->name }}</h5>
        <p class="card-text"> {{ $classroom->section }}- {{ $classroom->room }}</p>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-sm btn-primary">View</a>
            {{ $slot }}
        </div>

    </div>
</div>
