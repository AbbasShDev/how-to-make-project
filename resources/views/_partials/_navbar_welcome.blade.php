<div class="navbar-area">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('welcome') }}"><img class="logo" src="{{ asset('images/logo-white.png') }}" alt="white logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse py-3" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item pr-lg-4 mx-auto">
                        <a class="nav-link font-head" href="">اكتشف</a>
                    </li>
                    <li class="nav-item  mx-auto">
                        <a href="{{ route('login') }}"><button class="nav-link btn font-head login-btn">دخول</button></a>
                        <a href="{{ route('register') }}"><button class="nav-link btn font-head register-btn">تسجيل</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> <!-- container -->
</div> <!-- navbar area -->
