<x-main-layout title="Classrooms">

    {{-- <p> Welcome {{ $name }} , {{ $title  }} </p>
    <a href="{{ route('classrooms.show',['edit' => 1 ,'id' => 56], false)}}" >Create</a>
    <a href="{{ route(name: 'classrooms.create', absolute:false)}}" >Create</a> --}}
    <x-form.alert name="success" class="alert-success"></x-form.alert>
    <x-form.alert name="error" class="alert-danger"></x-form.alert>

    <ul id="cls"></ul>
    <div class="container">
        <x-search />
        <br>
        <h2>{!! __('Classrooms') !!}</h2>
        <div class="row">

            @foreach ($classrooms as $classroom)
                {{-- حجزنا 3 اعمدة * 4صفوف يعني 12   --}}
                <div class="col-md-3">
                    <x-form.card :classroom="$classroom">
                        <a href="{{ route('classrooms.edit', $classroom->id) }}"
                            class="btn btn-sm btn-dark">{{ __('Edit') }}</a>

                        <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger ">{{ __('Delete') }}</button>
                        </form>
                    </x-form.card>
                </div>
            @endforeach
        </div>
        <br>
        {{ $classrooms->withQueryString()->appends(['v' => 1])->links() }}
    </div>

    @push('scripts')
          <script>
            fetch('/api/classrooms')
                .then(res => res.josn())
                .then(json => {
                    let ul = document.getElementById('cls');
                    for (let i in json.classrooms) {
                        ul.innerHTML += `<li>${json.classrooms[i].name}</li>`
                    }
                })
        </script>
    @endpush
</x-main-layout>
