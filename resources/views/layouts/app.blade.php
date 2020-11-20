<!DOCTYPE html>
<html lang="en">
<head>
    @include('moon::layouts._head')
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

    @include('moon::layouts._scripts')
</body>
</html>