@include('partials.header')
<div class="container">
    <h1> Create Post</h1>
    <hr>
    <x-form.errors />
    <x-form.alert name="success" class="alert-success"></x-form.alert>
    <x-form.alert name="error" class="alert-danger"></x-form.alert>
    <form action="{{ route('classroom.post.store', ['classroom' => $classroom->id]) }}"
        method="POST">
        @csrf  
        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">

        <x-form.floating-control name="content">
            <x-slot name="label">
                <label for="content">Content</label>
            </x-slot>
            <x-form.textarea name="content" placeholder="Post Content"></x-form.textarea>
        </x-form.floating-control> 

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@include('partials.footer')
