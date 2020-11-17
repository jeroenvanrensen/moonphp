@extends('moon::layouts.auth')

@section('title', 'Login')

@section('content')
    <h1 class="text-2xl font-bold mb-8 lg:mb-4">Login</h1>

    @if(session()->has('error'))
        <div class="mb-8 lg:mb-4 bg-red-200 border border-red-300 px-4 py-2 rounded">{{ session()->get('error') }}</div>
    @endif

    @if(session()->has('message'))
        <div class="mb-8 lg:mb-4 bg-blue-200 border border-blue-300 px-4 py-2 rounded">{{ session()->get('message') }}</div>
    @endif
    
    <form action="{{ route('moon.auth.login') }}" method="post">
        @csrf

        <!-- Email -->
        <div class="mb-6 lg:mb-4">
            <label for="email" class="mb-3 lg:mb-2 block font-semibold">Email</label>
        
            <input
                type="email"
                name="email"
                id="email"
                class="border border-gray-400 rounded px-4 py-2 w-full focus:border-gray-500"
                value="{{ old('email') }}"
                required
            />
        </div>

        <!-- Password -->
        <div class="mb-6 lg:mb-4">
            <label for="password" class="mb-3 lg:mb-2 block font-semibold">Password</label>
        
            <input
                type="password"
                name="password"
                id="password"
                class="border border-gray-400 rounded px-4 py-2 w-full focus:border-gray-500"
                value="{{ old('password') }}"
                required
            />
        </div>

        <!-- Submit -->
        <button type="submit" class="px-4 py-2 bg-blue-500 rounded text-white hover:bg-blue-600 focus:bg-blue-600">Sign In</button>
    </form>
@endsection