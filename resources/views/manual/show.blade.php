@extends('layouts.app')

@push('css-links')

@endpush

@section('content')
    <section class="show-manual">
        <div class="banner d-flex justify-content-center position-relative">
            <img
                class="img-fluid mx-auto w-100 h-25"
                src="{{ $manual->banner ? presentImage($manual->banner): asset('images/default-banner.png') }}"
                alt="banner"
            >
            <div class="overlay"></div>
        </div>


        <div class="container mt-4 mb-5">
            <div class="description-container row mb-5">
                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                    <h1 class="title">{{ $manual->title }}</h1>
                    <p class="pt-3">{{ $manual->description }}</p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid mx-auto rounded-lg" src="{{ presentImage($manual->logo) }}" alt="logo">
                    </div>
                </div>
            </div>

            @foreach($manual->tutorials as $tutorial)
                <a href="{{ route("tutorial.show", $tutorial) }}">
                    <div class="tutorial-list-item row mx-2 rounded-lg bg-white my-2 justify-content-between">
                        <div class="col-3 col-lg-1 p-0">
                            <img class="img-fluid mx-auto" src="{{ presentImage($tutorial->main_image) }}"
                                 alt="main image">
                        </div>
                        <div class="col-9 col-lg-11 pt-3 pr-4">
                            <h6>{{ $tutorial->title }}</h6>
                            <p>{{ mb_substr($tutorial->description, 0, 50)."..."}}</p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </section>
@endsection
