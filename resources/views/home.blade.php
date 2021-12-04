@extends('layouts.app')

@push('css-links')

@endpush

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success my-3">
                <p class="m-0">
                    {!! session()->get('success')  !!}
                </p>
            </div>
        @endif

        <div class="row d-flex justify-content-center justify-content-sm-start">
            @foreach($posts as $post)
                <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ $post->url }}">
                        <div class="card mt-4 home-card">
                            <img class="card-img-top" src="{{ $post->post_image }}" alt="{{ $post->title }}">
                            <div class="card-body">
                                <h5 class="card-title text-dark">
                                    {{ mb_strlen($post->title) > 20 ? mb_substr($post->title, 0, 20).'...' :  $post->title}}
                                </h5>
                                <p class="card-text text-muted">
                                    {{ mb_strlen($post->description) > 100 ? mb_substr($post->description, 0, 100).'...' :  $post->description}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js-scripts')

@endpush
