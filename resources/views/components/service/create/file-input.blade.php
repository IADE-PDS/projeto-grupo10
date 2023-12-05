@props(['disabled' => false])

<input type="file"
    multiple
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'w-full max-w-xs file-input file-input-bordered file-input-success']) !!}
>
