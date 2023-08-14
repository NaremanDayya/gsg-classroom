@include('partials.header')
<div class="container">
    <h1> {{ $classroom->name }} (# {{ $classroom->id }})</h1>
    <h1> {{ $classwork->title }}</h1>
    <x-form.alert name="success" class="alert-success"></x-form.alert>
    <x-form.alert name="error" class="alert-danger"></x-form.alert>
    <hr>
    <div>
        <p>
            {{ $classwork->description }}
        </p>
    </div>
    <h4>Comments</h4>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $classwork->id }}">
        <input type="hidden" name="type" value="classwork">
        <div class="d-flex">
            <div class="col-8">
                <x-form.floating-control>
                    <x-slot:label>
                        <label for="content">Commment (optional)</label>
                    </x-slot:label>
                    <x-form.textarea name="content" placeholder="Commment"/>
                    <x-form.input-error name="commment"></x-form.input-error>
                </x-form.floating-control>
            </div>

            <div class="ms-1">
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </div>
        </div>
    </form>
    <div class="mt-4">
        @foreach ($classwork->comments as $comment)
            <div class="d-flex align-items-center">
                <div class="row">
                    <div class="col-md-2">
                        <img src="">
                    </div>
                    <div class="col-md-10">
                        <p>By:
                            {{ $comment->user->name }}.Time:{{ $comment->created_at->diffForHumans(null, true, true) }}
                        </p>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('partials.footer')
