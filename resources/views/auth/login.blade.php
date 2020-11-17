@extends('moon::layouts.auth')

@section('title', 'Login')

@section('content')
    <h1 class="mb-4">Login</h1>

    @if(session()->has('error'))
        <div class="alert alert-danger">Test</div>
    @endif
    
    <form action="{{ route('moon.auth.login') }}" method="post">
        @csrf

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
        
            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="{{ old('email') }}"
                required
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
                required
            />
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection