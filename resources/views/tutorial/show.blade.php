@extends('layouts.app')

@push('css-links')

@endpush

@push('css-additional-styles')
    <style>
        html {
            scroll-behavior: smooth;
        }
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-tachometer-alt fa-fw"></i>
                            الصعوبة
                        </span>
                        <span>{{ $tutorial->difficulty }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="far fa-clock fa-fw"></i>
                            المدة
                        </span>
                        <span>{{ $tutorial->duration." ".$tutorial->duration_measurement }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="far fa-building fa-fw"></i>
                            المجال
                        </span>
                        <span>{{ $tutorial->area }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-tags fa-fw"></i>
                            التصنيفات
                        </span>
                        <span>
                            @foreach($tutorial->tags as $tag)
                                <h4 class="d-inline"><span class="badge badge-dark m-0">{{ $tag->name }}</span></h4>
                            @endforeach
                        </span>
                    </li>
                    <li class="list-group-item d-flex flex-column">
                        <span class="d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-list-ol fa-fw"></i>
                            المحتوى
                            </span>
                            <span>[<span class="show-hide-intro-content">إخفاء</span>]</span>
                        </span>

                        <span class="mt-2 intro-content">
                            @if($tutorial->introduction)<a href="{{ request()->fullUrl()."#introduction" }}">المقدمة</a>@endif
                            @if($tutorial->introduction_video)<a href="{{ request()->fullUrl()."#introduction_video" }}">فيديو توضيحي</a>@endif
                            @foreach($tutorial->steps as $step)
                                    <a href="{{ request()->fullUrl()."#step".$step->order }}">خطوة {{ $step->order }} - {{ $step->title }}</a>
                            @endforeach
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="custom-doted-hr">

        @if($tutorial->introduction)
            <div id="introduction">
                <h1>المقدمة</h1>
                <p>
                    {!! $tutorial->introduction !!}
                </p>
            </div>
            <hr class="custom-doted-hr">
        @endif

        @if($tutorial->introduction_video)
        <div id="introduction_video">
            <h1>فيديو توضيحي</h1>
            <div class="col-12 col-md-10 mx-auto">
                <div class="embed-responsive embed-responsive-16by9 mt-4">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $tutorial->introduction_video }}" allowfullscreen></iframe>
                </div>
            </div>
            <hr class="custom-doted-hr">
        </div>
        @endif

        @if($tutorial->introduction && $tutorial->introduction_video) <hr class="custom-doted-hr"> @endif

        @foreach($tutorial->steps as $step)
            <div id="step{{ $step->order }}" class="single-step row my-4">
                <div class="col-md-5">
                    <h3>{{ $step->title }}</h3>
                    <p>{!! $step->content !!}</p>
                </div>
                <div class="col-md-7 d-flex flex-column image-gallery">
                    <img class="img-fluid active-image" src="{{ presentImage($step->images[0]) }}" alt="step image">
                    <div class="row">
                        @foreach($step->images as $image)
                            <img class="img-fluid images-list-item @if($loop->first) active @endif" src="{{ presentImage($image) }}" alt="step image">
                        @endforeach
                    </div>
                </div>
            </div>
            @if(! $loop->last) <hr class="custom-doted-hr"> @endif
        @endforeach
    </div>
@endsection

@push('js-scripts')
    <script>
        $(function () {
            $('.show-hide-intro-content').on('click', function(){
                if ($(this).text() == "إخفاء"){
                    $(this).text("إظهار")
               }else {
                   $(this).text("إخفاء")
                }
                $('.intro-content').slideToggle();
            });

            //image gallery

            $(".image-gallery .images-list-item").each(function () {
                $(this).on("click", function () {
                    $(this).parents('.row').siblings(".active-image").hide().attr("src", $(this).attr("src")).fadeIn();
                    $(this).addClass("active").siblings().removeClass("active")
                })
            })
        })
    </script>

@endpush
