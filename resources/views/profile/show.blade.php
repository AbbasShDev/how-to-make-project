@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid mx-auto rounded-lg" src="{{ presentProfileImage($user->name, 512) }}"
                     alt="{{ $user->name }} image">

                <hr class="custom-doted-hr">

                <h3 class="mt-3">{{ $user->name }}</h3>
                <h6 class="mt-2 text-muted">تاريخ التسجيل: {{ $user->created_at->diffForHumans() }}</h6>

                @if($user->date_of_birth || $user->bio || $user->personal_website)
                    <hr class="custom-doted-hr">

                    @if($user->date_of_birth)
                        <h6 class="mt-3">
                            <i class="fas fa-birthday-cake fa-fw"></i>
                            {{ $user->date_of_birth->translatedFormat('j F') }}
                        </h6>
                    @endif

                    @if($user->date_of_birth)
                        <h6 class="mt-3">
                            <i class="fas fa-globe fa-fw"></i>
                            <a href="{{ $user->personal_website }}"
                               target="_blank">{{ presentUrl($user->personal_website) }}</a>
                        </h6>
                    @endif

                    @if($user->bio)
                        <p class="bg-white text-dark rounded-lg p-2 mt-3">{{ $user->bio }}</p>
                    @endif
                @endif

            </div>
            <div class="col-md-9">
                <div class="nav-tabs-boxed">
                    <div class="row justify-content-between pl-2" style="padding-right: 15px !important;">
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile-tutorials"
                                                    role="tab" aria-controls="home" aria-selected="true">الإرشادات</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-articles"
                                                    role="tab"
                                                    aria-controls="profile" aria-selected="false">المقالات</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-manuals"
                                                    role="tab"
                                                    aria-controls="messages" aria-selected="false">الكتيبات</a></li>
                        </ul>
                        @if(auth()->user()?->is($user))
                            <a href="{{ route('profile.edit', $user) }}">
                                <button class="btn btn-sm btn-dark mr-2 float-left" type="button">تعديل الملف الشخصي
                                </button>
                            </a>
                        @endif
                    </div>
                    <div class="tab-content" style="border-radius: 0 !important;">
                        <div class="tab-pane active" id="profile-tutorials" role="tabpanel">
                            <div class="row">
                                @forelse($user->tutorials as $tutorial)
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ route("tutorial.show", $tutorial) }}">
                                            <div class="card profile-card">
                                                <img class="card-img-top"
                                                     src="{{ presentImage($tutorial->main_image) }}"
                                                     alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ mb_strlen($tutorial->title) > 35 ? mb_substr($tutorial->title, 0,35)."..." : $tutorial->title}}</h5>
                                                    <p class="card-text">{{ mb_strlen($tutorial->description) > 100 ? mb_substr($tutorial->title, 0,100)."..." : $tutorial->description}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <h3 class="p-5 mx-auto">لايوجد إرشادات لعرضها</h3>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane" id="profile-articles" role="tabpanel">
                            <div class="row">
                                @forelse($user->articles as $article)
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ route("article.show", $article) }}">
                                            <div class="card profile-card">
                                                <img class="card-img-top" src="{{ presentImage($article->main_image) }}"
                                                     alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ mb_strlen($article->title) > 35 ? mb_substr($article->title, 0,35)."..." : $article->title}}</h5>
                                                    <p class="card-text">{{ mb_strlen($article->description) > 100 ? mb_substr($article->title, 0,100)."..." : $article->description}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <h3 class="p-5 mx-auto">لايوجد مقالات لعرضها</h3>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane" id="profile-manuals" role="tabpanel">
                            <div class="row">
                                @forelse($user->manuals as $manual)
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ route("manual.show", $manual) }}">
                                            <div class="card profile-card">
                                                <img class="card-img-top" src="{{ presentImage($manual->logo) }}"
                                                     alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ mb_strlen($manual->title) > 35 ? mb_substr($manual->title, 0,35)."..." : $manual->title}}</h5>
                                                    <p class="card-text">{{ mb_strlen($manual->description) > 100 ? mb_substr($manual->title, 0,100)."..." : $manual->description}}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <h3 class="p-5 mx-auto">لايوجد كتيبات لعرضها</h3>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
