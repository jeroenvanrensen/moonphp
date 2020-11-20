<!DOCTYPE html>
<html lang="en">
<head>
    @include('moon::layouts._head')
</head>
<body class="bg-gray-200">
    <div class="container mx-auto px-4">
        <div class="h-screen flex justify-center items-center">
            <div class="bg-white w-full md:w-4/5 lg:w-1/2 xl:w-2/5 shadow rounded py-8 px-8">
                @yield('content')
            </div>
        </div>
    </div>

    @include('moon::layouts._scripts')
</body>
</html>