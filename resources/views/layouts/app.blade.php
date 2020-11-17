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
        @include('moon::layouts._sidebar')

        <main class="w-5/6">
            @include('moon::layouts._navbar')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>