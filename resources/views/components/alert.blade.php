<div 
    {{ $attributes->merge([
        'class' => 'mb-8 lg:mb-4 bg-' . $color . '-200 border border-' . $color . '-300 px-4 py-2 rounded'
    ]) }}
>
    {{ $slot }}
</div>