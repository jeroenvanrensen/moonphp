<span
    {{ $attributes->merge([ 
        'class' => 'text-sm text-red-600'
    ]) }}
>
    {{ $slot }}
</span>