@extends('layouts.app')

@section('content')

    <div class="login-register">
        <!-- login-register -->
        <div class="container col-10 col-lg-4 login-page">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <img class="mx-auto d-block my-3" src="{{ asset('images/logo-black.png') }}" alt="Logo">
            <p class="text-center font-head ">{{ __('Reset Password') }}</p>

            <form class="sign" action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="input-container">
                    <input id="email" type="email"  class="form-control mt-3 @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <input type="submit" class="btn btn-block mt-3" name="login" value="{{ __('Send Password Reset Link') }}">

            </form>
        </div>
    </div>
@endsection
