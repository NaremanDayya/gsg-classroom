@include('partials.header')
<div class="container">
    <h1> Edit Post</h1>
    <x-form.alert name="success" class="alert-success"></x-form.alert>
    <x-form.alert name="error" class="alert-danger"></x-form.alert>
    <form action="{{ route('classroom.post.update', ['classroom' => $classroom->id,'post'=> $post->id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">

                <x-form.floating-control name="content">
                    <x-slot name="label">
                        <label for="content">Content</label>
                    </x-slot>
                    <x-form.textarea name="content" :value="$post->content" placeholder="Post Content"></x-form.textarea>
                </x-form.floating-control>        <button type="submit" class="btn btn-primary">Edit Post</button>
    </form>
   
</div>
@include('partials.footer')