<label 
    {{ $attributes->merge([
        'class' => 'block font-semibold'
    ]) }}
>
    {{ $slot }}
</label>