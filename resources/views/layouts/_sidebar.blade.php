<aside class="bg-gray-700 w-1/6 h-screen block">
    <div class="h-16 bg-gray-800 shadow px-6 flex items-center">
        <span class="text-white font-semibold">Moon PHP</span>
    </div>

    <div class="px-6 py-8 text-gray-200">
        <ul>
            <li class="font-semibold cursor-pointer">Dashboard</li>
            <li class="text-sm uppercase text-gray-500 font-bold mt-6 tracking-wide">Resources</li>

            @foreach(['Users', 'Posts', 'Pages', 'Categories'] as $resource)
                <li class="font-semibold cursor-pointer mt-2">{{ $resource }}</li>
            @endforeach
        </ul>
    </div>
</aside>