<x-form.floating-control>
    <x-slot:label>
        <label for="name">Classroom Name</label>
    </x-slot:label>
    <x-form.input name="name" :value="$classroom->name" placeholder="Classroom Name"></x-form.input>
    <x-form.input-error name="name"></x-form.input-error>
</x-form.floating-control>

<x-form.floating-control>
    <x-slot:label>
        <label for="section">Section</label>
    </x-slot:label>
    <x-form.input name="section" :value="$classroom->section" placeholder="Classroom Section"></x-form.input>
    <x-form.input-error name="section"></x-form.input-error>
</x-form.floating-control>

<x-form.floating-control>
    <x-slot:label>
        <label for="subject">Subject</label>
    </x-slot:label>
    <x-form.input name="subject" :value="$classroom->subject" placeholder="Classroom Subject"></x-form.input>
    <x-form.input-error name="subject"></x-form.input-error>
</x-form.floating-control>

<x-form.floating-control>
    <x-slot:label>
        <label for="room">Room</label>
    </x-slot:label>
    <x-form.input name="room" :value="$classroom->room" placeholder="Classroom Room"></x-form.input>
    <x-form.input-error name="room"></x-form.input-error>
</x-form.floating-control>

<x-form.floating-control>
    <x-slot:label>
        <label for="cover_image">Cover Image</label>
    </x-slot:label>
    <x-form.input type="file" name="cover_image" :value="$classroom->cover_image" placeholder="Classroom Cover Image">
        @if ($classroom->cover_image_path)
            <x-slot:label>
                <img src="{{ asset('uploads/' . $classroom->cover_image_path) }}" alt="Cover Image">
            </x-slot:label>
        @endif
    </x-form.input>
    <x-form.input-error name="cover_image"></x-form.input-error>
</x-form.floating-control>

<button type="submit" class="btn btn-primary">{{ $button_label }}</button>
</div>
