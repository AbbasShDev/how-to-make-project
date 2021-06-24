@extends('layouts.app')

@push('css-links')

@endpush

@push('css-additional-styles')
    <style>
        body {
            background-color: #ffffff !important;
        }
    </style>
@endpush
@section('content')
    <div class="container mt-3 mb-5 show-tutorial">
        <h1 class="mb-2">{{ $tutorial->title }}</h1>
        <p><i class="fas fa-user-circle fa-fw"></i>
            الكاتب:
            <a href="">{{ $tutorial->user->name }}</a>
             |
            <i class="fas fa-pen-square fa-fw"></i>
            آخر تعديل:
            {{ $tutorial->updated_at->format('d/m/Y') }}
        </p>
        <hr class="p-0 custom-doted-hr">

        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid main-image" src="{{ presentImage($tutorial->main_image) }}" alt="main image">
            </div>
            <div class="col-md-8 mt-3 mt-md-0">
                <p>{{ $tutorial->description }}</p>
                <ul class="list-group">
                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                        <span><i class="fas fa-tachometer-alt fa-fw"></i>
                            الصعوبة
                        </span>
                        <span>{{ $tutorial->difficulty }}</span>
                    </li>
                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                        <span><i class="far fa-clock fa-fw"></i>
                            المدة
                        </span>
                        <span>{{ $tutorial->duration." ".$tutorial->duration_measurement }}</span>
                    </li>
                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                        <span><i class="far fa-building fa-fw"></i>
                            المجال
                        </span>
                        <span>{{ $tutorial->area }}</span>
                    </li>
                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                        <span><i class="fas fa-tags fa-fw"></i>
                            التصنيفات
                        </span>
                        <span>
                            @foreach($tutorial->tags as $tag)
                                <h4 class="d-inline"><span class="badge badge-dark m-0">{{ $tag->name }}</span></h4>
                            @endforeach
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('js-scripts')

@endpush
