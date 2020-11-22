<div>
    <h1 class="text-2xl font-bold mb-8 lg:mb-4">Login</h1>

    @if(session()->has('error'))
        <x-moon::alert color="red">{{ session()->get('error') }}</x-moon::alert>
    @endif

    @if(session()->has('message'))
        <x-moon::alert color="blue">{{ session()->get('message') }}</x-moon::alert>
    @endif

    <form wire:submit.prevent="login">
        @csrf

        <!-- Email -->
        <div class="mb-6 lg:mb-4">
            <x-moon::label for="email" class="mb-3 lg:mb-2">Email</x-moon::label>
        
            <x-moon::input
                wire:model.lazy="email"
                type="text"
                name="email"
                id="email"
            />

            @error('email')
                <x-moon::form-error>{{ $message }}</x-moon::form-error>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-6 lg:mb-4">
            <x-moon::label for="password" class="mb-3 lg:mb-2">Password</x-moon::label>
        
            <x-moon::input
                wire:model.lazy="password"
                type="password"
                name="password"
                id="password"
            />

            @error('password')
                <x-moon::form-error>{{ $message }}</x-moon::form-error>
            @enderror
        </div>

        <!-- Submit -->
        <x-moon::button wire:loading.class="opacity-75 pointer-events-none" wire:target="login" type="submit" class="flex items-center">
            <svg wire:loading wire:target="login" class="animate-spin mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Sign In
        </x-moon::button>
    </form>
</div>