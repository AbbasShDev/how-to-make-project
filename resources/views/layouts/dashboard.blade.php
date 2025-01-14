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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@3.4.0/dist/css/coreui.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    @stack('css-links')
</head>
@stack('css-additional-styles')
<body>
<!-- Start article preloader -->
<div id="preloader">
    <div id="status">
    </div>
</div>
<!-- End article preloader -->

<!-- End sidebar -->
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <a href="{{ route("home") }}"><img class="c-sidebar-brand-full" style="width: 100px !important;"
                                           src="{{ asset("images/logo-white.png") }}" alt="logo"></a>
        <a href="{{ route("home") }}"><img class="c-sidebar-brand-minimized" style="width: 70px !important;"
                                           src="{{ asset("images/logo-white.png") }}" alt="logo"></a>
    </div>
    <ul class="c-sidebar-nav ps ps__rtl ps--active-y">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('dashboard.index') }}"
               class="c-sidebar-nav-link {{ Route::is('dashboard.index') ? 'c-active' : '' }} ">
                <i class="c-sidebar-nav-icon fas fa-tachometer-alt fa-fw"></i>
                لوحة التحكم
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href=" {{ route('dashboard.tutorial.index') }}"
               class="c-sidebar-nav-link {{ Route::is('dashboard.tutorial.index') ? 'c-active' : '' }} ">
                <i class="c-sidebar-nav-icon fas fa-list-ol fa-fw"></i>
                الإرشادات
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('dashboard.article.index') }}"
               class="c-sidebar-nav-link {{ Route::is('dashboard.article.index') ? 'c-active' : '' }} ">
                <i class="c-sidebar-nav-icon far fa-file-alt fa-fw"></i>
                المقالات
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('dashboard.manual.index') }}"
               class="c-sidebar-nav-link {{ Route::is('dashboard.manual.index') ? 'c-active' : '' }} ">
                <i class="c-sidebar-nav-icon fa fa-book fa-fw"></i>
                الكتيبات
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('profile.edit', auth()->user()) }}"
               class="c-sidebar-nav-link {{ Route::is('profile.edit') ? 'c-active' : '' }} ">
                <i class="c-sidebar-nav-icon fas fa-user-circle fa-fw"></i>
                الحساب
            </a>
        </li>

        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 504px; left: 250px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 340px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
<!-- End sidebar -->

<!-- End content -->
<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
            <i class="c-icon c-icon-lg fas fa-bars"></i>
        </button>
        <a class="c-header-brand d-lg-none" href="{{ route("home") }}">
            <img style="width: 100px !important;" src="{{ asset("images/logo-white.png") }}" alt="logo">
        </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
            <i class="c-icon c-icon-lg fas fa-bars"></i>
        </button>
        <ul class="c-header-nav d-md-down-none mx-0 ml-auto ">
            @include('_partials._right_nav_items')
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="c-header-nav mr-auto ml-2">
            <li class="nav-item d-md-down-none">
                <button class="btn btn-info mx-0 mx-lg-3" type="button" data-toggle="modal" data-target="#infoModal"><i
                        class="fas fa-pencil-alt fa-fw"></i> قم بإنشاء صفحة
                </button>
            </li>

            <!-- Authentication Links -->
            @include('_partials._left_nav_profile_dropdown')

        </ul>


    </header>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @if(session()->has('success'))
                    <div class="alert alert-success m-3 fade-in">
                        <p class="m-0">
                            {{ session()->get('success') }}
                        </p>
                    </div>
                @endif
                <div class="fade-in">
                    <!-- Start inner content -->
                @yield('content')
                <!-- End inner content -->
                </div>
            </div>
        </main>
        {{--        //if page is edit d-none--}}
        {{--        <footer class="c-footer">--}}
        {{--            <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>--}}
        {{--            <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>--}}
        {{--        </footer>--}}
    </div>
</div>
<!-- End content -->

<!-- Start modal -->
@include('_partials._modal')
<!-- End modal -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
@stack('js-scripts')
<script>
    $(function () {
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
<script>
    $(window).on('load', function () {
        $('#status').fadeOut();
        $('#preloader').delay(50).fadeOut(100)
        $('body').delay(50).css({'overflow': 'visible'})
    })
</script>
</body>
</html>
