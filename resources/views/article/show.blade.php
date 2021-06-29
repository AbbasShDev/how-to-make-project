@extends('layouts.app')

@push('css-links')

@endpush

@section('content')
    <div class="container mt-3 mb-5 show-tutorial">
        <h1 class="mb-2">{{ $article->title }}</h1>
        <div>
            <i class="fas fa-user-circle fa-fw"></i>
            الكاتب:
            <a href="">{{ $article->user->name }}</a>
             |
            <i class="fas fa-pen-square fa-fw"></i>
            آخر تعديل:
            {{ $article->updated_at->format('d/m/Y') }}
            |
            <i class="fas fa-tags fa-fw"></i>
            التصنيفات:
            @foreach($article->tags as $tag)
                <h5 class="d-inline"><span class="badge badge-dark m-0">{{ $tag->name }}</span></h5>
            @endforeach

        </div>
        <hr class="p-0 custom-doted-hr">

        <div>
            <p>{{ $article->description }}</p>
            <div class="d-flex justify-content-center">
                <img class="img-fluid mx-auto" src="{{ presentImage($article->main_image) }}" alt="main image">
            </div>
        </div>

        <hr class="custom-doted-hr">

        <div>
            {!!  $article->article !!}
        </div>
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
