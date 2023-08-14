@include('partials.header')
<x-form.alert name="success" class="alert-success"></x-form.alert>
<x-form.alert name="error" class="alert-danger"></x-form.alert>

<div class="container">
    <x-search />
<br>
    <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
    <h3>Classworks
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                + Create
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item"
                        href="{{ route('classroom.classwork.create', [$classroom->id, 'type' => 'assignment']) }}">Assignment</a>
                </li>
                <li><a class="dropdown-item"
                        href="{{ route('classroom.classwork.create', [$classroom->id, 'type' => 'material']) }}">Material</a>
                </li>
                <li><a class="dropdown-item"
                        href="{{ route('classroom.classwork.create', [$classroom->id, 'type' => 'question']) }}">Question</a>
                </li>
            </ul>
        </div>
    </h3>
    <hr>
    @forelse ( $classworks as $group)

        <h3>{{ $group->first()->topic->name ?? '' }}</h3>

        <div class="accordion accordion-flush" id="accordionFlushExample">

            @foreach ($group as $classwork)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $classwork->id }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $classwork->id }}">
                            {{ $classwork->title }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $classwork->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            {{ $classwork->description }}
                        </div>
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('classroom.classwork.edit',[$classroom->id ,$classwork->id]) }}">EDIT</a>
                    </div>
                </div>
            @endforeach
        </div>

    @empty
        <p class="text-center fs-4"> No Classworks Found.</p>
    @endforelse
</div>
@include('partials.footer')
