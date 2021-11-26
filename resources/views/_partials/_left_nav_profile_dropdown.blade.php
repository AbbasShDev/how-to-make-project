@guest
    @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
    @endif

    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif
@else
    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
           aria-expanded="false">
            <div class="c-avatar my-2 my-lg-0">
                <img class="c-avatar-img" src="{{ presentProfileImage(auth()->user()) }}"
                     alt="{{ auth()->user()->name }} img">
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0 mb-3 mb-lg-0">
            <div class="dropdown-header bg-light py-2 text-right">
                <strong>{{ auth()->user()->name }}</strong>
            </div>
            <a class="dropdown-item" href="{{ route('profile.show', auth()->user()) }}">
                <i class="c-icon mfe-2 fas fa-user-circle fa-fw"></i>
                الملف الشخصي
            </a>
            <a class="dropdown-item" href="{{route('dashboard.index')}}">
                <i class="c-icon mfe-2 fas fa-tachometer-alt fa-fw"></i>
                لوحة التحكم
            </a>

            <a class="dropdown-item" href="{{ route("profile.edit", auth()->user()) }}">
                <i class="c-icon mfe-2 fas fa-cog fa-fw"></i>
                الإعدادات
            </a>
            <div class="dropdown-item d-lg-none" href="#">
                <button class="btn btn-sm btn-info" type="button" data-toggle="modal"
                        data-target="#infoModal"><i class="fas fa-pencil-alt fa-fw"></i> قم بإنشاء صفحة
                </button>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                <i class="c-icon mfe-2 text-danger fas fa-sign-out-alt fa-fw"></i>
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
@endguest
