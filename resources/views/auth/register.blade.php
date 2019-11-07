@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-xs mt-20">
        <h1 class="text-2xl text-center text-gray-500 mb-6">{{ __('Register') }}</h1>
        <form method="POST"
            action="{{ route('register') }}"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

            @csrf
            <div class="mb-4">
                <label for="name"
                    class="label">
                    {{ __('Name') }}
                </label>

                <input id="name"
                    class="input @error('name') border-red-500 @enderror"
                    type="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus>

                @error('name')
                <p role="alert"
                    class="input__error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email"
                    class="label">
                    {{ __('E-Mail Address') }}
                </label>

                <input id="email"
                    class="input @error('email') border-red-500 @enderror"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email">

                @error('email')
                <p role="alert"
                    class="input__error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password"
                    class="label">
                    {{ __('Password') }}
                </label>

                <input id="password"
                    class="input @error('password') border-red-500 @enderror"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    autofocus>

                @error('password')
                <p role="alert"
                    class="input__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password-confirm"
                    class="label">
                    {{ __('Confirm Password') }}
                </label>

                <input id="password-confirm"
                    class="input @error('password-confirm') border-red-500 @enderror"
                    type="password-confirm"
                    name="password-confirm"
                    required
                    autocomplete="new-password"
                    autofocus>

                @error('password-confirm')
                <p role="alert"
                    class="input__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2019 {{ config('app.name', 'Laravel') }}. All rights reserved.
        </p>
    </div>
</div>
@endsection
