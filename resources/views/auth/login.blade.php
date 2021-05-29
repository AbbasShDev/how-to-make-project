@extends('layouts.app')

@section('content')
    <div class="login-register">
        <!-- login-register -->
        <div class="container col-10 col-lg-4 login-page">
            <img class="mx-auto d-block my-3" src="{{ asset('images/logo-black.png') }}" alt="Logo">
            <p class="text-center font-head ">تسجيل دخول</p>

            <form class="sign" action="{{ route('login') }}" method="post">
                @csrf

                <div class="input-container">
                    <input id="email" type="email"  class="form-control mt-3 @error('email') is-invalid @enderror" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-container">
                    <input id="password" type="password" class="form-control mt-3 @error('password') is-invalid @enderror" placeholder="كلمة المرور" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row mt-3">
                    <div class="col-md-6 offset-md-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-block mb-3" name="login" value="دخول">

                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
