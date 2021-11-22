@extends('layouts.app')

@section('content')
    <div class="login-register">
        <!-- login-register -->
        <div class="container col-10 col-lg-4 login-page">
            <img class="mx-auto d-block my-3" src="{{ asset('images/logo-black.png') }}" alt="Logo">
            <p class="text-center font-head ">تسجيل حساب جديد</p>

            <form class="sign" action="{{ route('register') }}" method="post">
                @csrf

                <div class="input-container">
                    <input id="name" type="text" class="form-control mt-3 @error('name') is-invalid @enderror"
                           name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required
                           autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="input-container">
                    <input id="email" type="email" class="form-control mt-3 @error('email') is-invalid @enderror"
                           name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required
                           autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-container">
                    <input id="password" type="password"
                           class="form-control mt-3 @error('password') is-invalid @enderror" placeholder="كلمة المرور"
                           name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-container">
                    <input id="password-confirm" type="password" class="form-control mt-3 "
                           placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required
                           autocomplete="new-password">
                </div>

                <input type="submit" class="btn btn-block mb-3 mt-3" name="login" value="تسجيل">

                <a class="font-head" href="{{ route('login') }}">لديك حساب؟ سجل دخول من هنا</a>
            </form>
        </div>
    </div>
@endsection
