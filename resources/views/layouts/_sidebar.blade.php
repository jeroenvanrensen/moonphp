<aside class="bg-gray-700 w-1/6 h-screen block">
    <div class="h-16 bg-gray-800 shadow px-6 flex items-center">
        <span class="text-white font-semibold">Moon PHP</span>
    </div>

    <div class="px-6 py-8 text-gray-200">
        <ul>
            <li class="font-semibold cursor-pointer"><a href="{{ route('moon.dashboard') }}" class="outline-none">Dashboard</a></li>
            <li class="text-sm uppercase text-gray-500 font-bold mt-6 tracking-wide">Resources</li>

            @foreach($resources as $resource)
                <li class="font-semibold mt-2">
                    <a href="{{ route('moon.resources.index', $resource['slug']) }}" class="outline-none">
                        {{ $resource['name_plural'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>