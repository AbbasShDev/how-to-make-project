<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app-rtl.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom_app_style.css') }}" rel="stylesheet">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<style>
    .select2-container .selection {
        width: 100%;
    }
    .select2-container .select2-selection {
        border-top-left-radius: 4px !important;
        border-top-right-radius: 4px !important;
        border-bottom-right-radius: 4px !important;
        border-bottom-left-radius: 4px !important;
        padding-right: 5px !important;
    }

    .select2-container .select2-selection .select2-selection__clear {
        display: none;
    }

    /*.select2-container .select2-selection .select2-search.select2-search--inline {*/
    /*    width: 100%;*/
    /*}*/
    .select2-dropdown.select2-dropdown--above,
    .select2-dropdown.select2-dropdown--below {
        display: none !important;
    }


</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark py-0 px-3 px-lg-5">
    <a class="navbar-brand" href="#"><img class="logo" src="{{ asset('images/logo-white.png') }}" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0">
            <input class="search-input form-control mr-sm-2" type="text" placeholder="Search">
        </form>

        <ul class="navbar-nav mx-0 ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Disabled</a>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button class="btn btn-info mx-0 mx-lg-3" type="button" data-toggle="modal" data-target="#infoModal"><i class="fas fa-pencil-alt fa-fw"></i> قم بإنشاء صفحة</button>
            </li>
            <!-- Authentication Links -->
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
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
<!-- Start content -->
    @yield('content')
<!-- End content -->

<!-- Start modal -->
    @include('_partials._modal')
<!-- End modal -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

{{--<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('js-scripts')
<script>
    $(function() {
        $('.create-modal .modal-body .nav-tabs .tab-btn').each(function (index) {
            let modalCreateInfo = $('.create-modal .modal-body .tab-content .modal-create-info h6')
            let modalCreateForm = $('.create-modal .modal-body .tab-content .modal-create-form')
            let titleInput = $('.create-modal .modal-body .tab-content .modal-create-form .title-input')


            $(this).on('click', function () {

                console.log($(this).data('formtitle'))
                console.log($(this).data('formaction'))
                console.log($(this).data('formdescription'))

                modalCreateInfo.text('').text($(this).data('formdescription'))
                modalCreateForm.attr('action', $(this).data('formaction'))
                titleInput.attr('placeholder', $(this).data('formtitle'))
            })
        })


    });

</script>
</body>
</html>
