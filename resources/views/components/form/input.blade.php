@props([
    'name', 'type' => 'text', 'value' => '',
    ])

    <input type={{ $type }} 
    value="{{ old($name, $value) }}"
     name="{{ $name }}"
      id="{{ $id ?? $name }}"
      {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}>

