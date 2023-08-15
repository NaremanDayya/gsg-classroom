@include('partials.header')
<x-form.alert name="success" class="alert-success"></x-form.alert>
<x-form.alert name="error" class="alert-danger"></x-form.alert>

<div class="container">
    <x-search />
    <br>
    <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
    <h3> Posts </h3>
    <hr>
    @forelse ($posts as $post)
         <div class="post">
            <div class="post-header">
                <div class="user-info">
                    <h3>{{ $post->user->name }}</h3>
                    <p>Posted {{ $post->created_at->diffForHumans(null, true, true) }}</p>
                </div>
            </div>
            <div class="post-content">
                <p>{{ $post->content }}</p>
            </div>
            <div class="post-actions">
                <div class="comments">
                    <span>{{ count($post->comments) }}Comments</span>
                </div>
            </div>
        </div>
    

    @empty
        <p class="text-center fs-4"> No Posts Found.</p>
    @endforelse
    @include('partials.footer')
