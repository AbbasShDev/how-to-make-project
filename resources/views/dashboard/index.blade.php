@extends('layouts.dashboard')

@push('css-links')

@endpush

@section('content')
    <h3>لوحة التحكم</h3>

    <hr class="custom-doted-hr">

    <div class="row justify-content-around">

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-gradient-warning p-3 mfe-3 rounded-lg">
                        <i class="c-icon c-icon-xl fas fa-list-ol fa-fw"></i>
                    </div>
                    <div>
                        <h3 class="text-warning">{{ $tutorialsCount }}</h3>
                        <h6 class="text-uppercase font-weight-bold">عدد الإرشادات</h6>
                    </div>
                </div>
                <div class="card-footer px-3 py-2"><a
                        class="btn-block text-muted d-flex justify-content-between align-items-center" href=" {{ route('dashboard.tutorial.index') }}">
                        <span class="small font-weight-bold">عرض المزيد</span>
                        <i class="c-icon fas fa-chevron-left fa-fw"></i>
                    </a></div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-gradient-danger p-3 mfe-3 rounded-lg">
                        <i class="c-icon c-icon-xl fas fa-file-alt fa-fw"></i>

                    </div>
                    <div>
                        <h3 class="text-danger">{{ $articlesCount }}</h3>
                        <h6 class="text-uppercase font-weight-bold">عدد المقالات</h6>
                    </div>
                </div>
                <div class="card-footer px-3 py-2"><a
                        class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('dashboard.article.index') }}">
                        <span class="small font-weight-bold">عرض المزيد</span>
                        <i class="c-icon fas fa-chevron-left fa-fw"></i>
                    </a></div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="bg-gradient-success p-3 mfe-3 rounded-lg">
                        <i class="c-icon c-icon-xl fas fa-book fa-fw"></i>
                    </div>
                    <div>
                        <h3 class="text-success">{{ $manualsCount }}</h3>
                        <h6 class="text-uppercase font-weight-bold">عدد الكتيبات</h6>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ route('dashboard.manual.index') }}">
                        <span class="small font-weight-bold">عرض المزيد</span>
                        <i class="c-icon fas fa-chevron-left fa-fw"></i>
                    </a></div>
            </div>
        </div>

    </div>

@endsection

@push('js-scripts')

@endpush
