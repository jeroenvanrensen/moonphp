<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - MoonPHP</title>

    <link href="{{ asset('moonphp/css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-200">
    <div class="flex">
        <x-moon::sidebar />

        <main class="w-5/6">
            @include('moon::layouts._navbar')

            <div class="container mx-auto px-6 py-4 xl:pt-12">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>