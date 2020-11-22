<button
    {{ $attributes->merge([ 
        'class' => 'px-4 py-2 outline-none bg-blue-500 rounded text-white hover:bg-blue-600'
    ]) }}
>
    {{ $slot }}
</button>