<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow mt-10 border border-green-300">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-green-700" />
                <x-text-input id="name" class="block mt-1 w-full border-green-400 focus:border-green-600 focus:ring focus:ring-green-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-green-700" />
                <x-text-input id="email" class="block mt-1 w-full border-green-400 focus:border-green-600 focus:ring focus:ring-green-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-green-700" />
                <x-text-input id="password" class="block mt-1 w-full border-green-400 focus:border-green-600 focus:ring focus:ring-green-300"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-green-700" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-green-400 focus:border-green-600 focus:ring focus:ring-green-300"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="underline text-sm text-green-600 hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700 focus:ring-green-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
