@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-xs mt-20">
        <h1 class="text-2xl text-center text-gray-500 mb-6">{{ __('Login') }}</h1>
        <form method="POST"
            action="{{ route('login') }}"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

            @csrf
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
                    autocomplete="email"
                    autofocus>

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
                    value="{{ old('password') }}"
                    required
                    autocomplete="password"
                    autofocus>

                @error('password')
                <p role="alert"
                    class="input__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center mb-6">
                <input class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="ml-2"
                    for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2019 {{ config('app.name', 'Laravel') }}. All rights reserved.
        </p>
    </div>
</div>
@endsection
