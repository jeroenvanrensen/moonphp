@extends('moon::layouts.auth')

@section('title', 'Login')

@section('content')
    <h1 class="mb-4">Login</h1>
    
    <form action="{{ route('moon.auth.login') }}" method="post">
        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
        
            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="{{ old('email') }}"
            />
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
        
            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                value="{{ old('password') }}"
            />
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection