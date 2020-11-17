@extends('moon::layouts.auth')

@section('title', 'Login')

@section('content')
    <h1 class="text-2xl font-bold mb-8 lg:mb-4">Login</h1>

    @if(session()->has('error'))
        <x-moon::alert color="red">{{ session()->get('error') }}</x-moon::alert>
    @endif

    @if(session()->has('message'))
        <x-moon::alert color="blue">{{ session()->get('message') }}</x-moon::alert>
    @endif
    
    <form action="{{ route('moon.auth.login') }}" method="post">
        @csrf

        <!-- Email -->
        <div class="mb-6 lg:mb-4">
            <x-moon::label for="email" class="mb-3 lg:mb-2">Email</x-moon::label>
        
            <x-moon::input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                autofocus
            />
        </div>

        <!-- Password -->
        <div class="mb-6 lg:mb-4">
            <x-moon::label for="password" class="mb-3 lg:mb-2">Password</x-moon::label>
        
            <x-moon::input
                type="password"
                name="password"
                id="password"
                value="{{ old('password') }}"
                required
            />
        </div>

        <!-- Submit -->
        <x-moon::button type="submit">Sign In</x-moon::button>
    </form>
@endsection