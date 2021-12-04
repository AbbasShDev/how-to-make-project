<div class="navbar-area">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('welcome') }}"><img class="logo"
                                                                       src="{{ asset('images/logo-white.png') }}"
                                                                       alt="white logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse py-3" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item pr-lg-4 mx-auto">
                        <a class="nav-link font-head" href="{{ route('home') }}">اكتشف</a>
                    </li>
                    @guest
                        <li class="nav-item  mx-auto">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}">
                                    <button class="nav-link btn font-head login-btn">دخول</button>
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="nav-link btn font-head register-btn">تسجيل</button>
                                </a>
                            @endif

                        </li>
                    @else
                        <li class="nav-item dropdown pr-lg-4 mx-auto">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-caret-down fa-fw"></i> {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show', auth()->user()) }}">
                                    <i class="fas fa-user-circle fa-fw"></i>
                                    الملف الشخصي
                                </a>
                                <a class="dropdown-item" href="{{route('dashboard.index')}}">
                                    <i class="fas fa-tachometer-alt fa-fw"></i>
                                    لوحة التحكم
                                </a>
                                <a class="dropdown-item" href="{{ route("profile.edit", auth()->user()) }}">
                                    <i class="fas fa-cog fa-fw"></i>
                                    الإعدادات
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="text-danger fas fa-sign-out-alt fa-fw"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div> <!-- container -->
</div> <!-- navbar area -->
