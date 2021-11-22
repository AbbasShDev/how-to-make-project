@extends('layouts.dashboard')

@push('css-links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
@endpush

@push('css-additional-styles')
    <style>
        .uppy-Dashboard--modal .uppy-Dashboard-overlay,
        .uppy-Dashboard--modal .uppy-Dashboard-inner {
            z-index: 1030 !important;
        }

        .create-tutorial .bottom-save-bar {
            position: sticky !important;
            height: 50px !important;
        }

        .container-fluid {
            padding: 0 !important;
        }

    </style>
@endpush

@section('content')
    <div class="container mb-5">
        <h2 class="px-3 d-lg-flex">
            <div style="line-height: 1.4 !important;">تعديل الحساب:</div>
            <a href="{{ route('profile.show', $user) }}">
                <button class="btn btn-sm btn-pill btn-dark mr-2" type="button">عرض الملف الشخصي</button>
            </a>
        </h2>
        <hr class="custom-doted-hr">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile-edit-personal"
                                    role="tab" aria-controls="home" aria-selected="true">المعلومات الشخصية</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-edit-password" role="tab"
                                    aria-controls="profile" aria-selected="false">كلمة السر</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-edit-picture" role="tab"
                                    aria-controls="messages" aria-selected="false">الصورة الشخصية</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="profile-edit-personal" role="tabpanel">
                <form class="form-horizontal p-3" action="{{ route('profile.update', $user) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">الاسم</label>
                        <div class="col-md-6">
                            <input
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old("name") ? old("name") : $user->name }}"
                            >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="email">البريد الالكتروني</label>
                        <div class="col-md-6">
                            <input
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                type="email"
                                name="email"
                                autocomplete="email"
                                value="{{ old("email") ? old("email") : $user->email }}"
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="date_of_birth">تاريخ الميلاد</label>
                        <div class="col-md-6">
                            <input
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth"
                                type="date"
                                name="date_of_birth"
                                value="{{ old("date_of_birth") ? old("date_of_birth") : $user->date_of_birth }}"
                            >

                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr class="custom-doted-hr">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="personal_website">الموقع الشخصي</label>
                        <div class="col-md-6">
                            <input
                                class="form-control @error('personal_website') is-invalid @enderror"
                                id="personal_website"
                                type="url"
                                name="personal_website"
                                placeholder="https://www.mysite.com"
                                value="{{ old("personal_website") ? old("personal_website") : $user->personal_website ?? "" }}"
                            >

                            @error('personal_website')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="bio">النبذة التعريفية</label>
                        <div class="col-md-6">
                            <textarea
                                class="form-control @error('bio') is-invalid @enderror"
                                id="bio"
                                name="bio"
                                rows="9"
                                placeholder="تحدث عن نفسك"

                            >{{ old("bio") ? old("bio") : $user->bio }}</textarea>

                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-lg btn-info" type="submit">حفظ</button>

                </form>
            </div>
            <div class="tab-pane" id="profile-edit-password" role="tabpanel">
                <h1>profile-edit-password</h1>
            </div>
            <div class="tab-pane" id="profile-edit-picture" role="tabpanel">
                <h1>profile-edit-picture</h1>
            </div>
        </div>
    </div>

@endsection

@push('js-scripts')
    {{--    <script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>--}}
    {{--    <script src="https://releases.transloadit.com/uppy/locales/v1.20.1/ar_SA.min.js"></script>--}}
    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            var uppy = Uppy.Core({--}}
    {{--                restrictions: {--}}
    {{--                    maxFileSize: 5500000,--}}
    {{--                    maxNumberOfFiles: 1,--}}
    {{--                    minNumberOfFiles: 1,--}}
    {{--                    allowedFileTypes: ['image/*']--}}
    {{--                },--}}
    {{--                locale: Uppy.locales.ar_SA--}}
    {{--            })--}}
    {{--                .use(Uppy.Dashboard, {--}}
    {{--                    note: "يفضل التنسيق الأفقي (مثل 800 × 600 بكسل)",--}}
    {{--                })--}}
    {{--                .use(Uppy.ImageEditor, {--}}
    {{--                    target: Uppy.Dashboard,--}}
    {{--                    quality: 0.8--}}
    {{--                })--}}
    {{--                .use(Uppy.XHRUpload, {--}}
    {{--                    endpoint: "{{ route('upload.uppy.files') }}",--}}
    {{--                    formData: true,--}}
    {{--                    fieldName: 'file',--}}
    {{--                    headers: {--}}
    {{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--                    },--}}
    {{--                })--}}

    {{--            uppy.on('file-added', (file) => {--}}
    {{--                console.log('Added file', file)--}}
    {{--            })--}}

    {{--            uppy.on('complete', (result) => {--}}
    {{--                $('.create-tutorial .create-tutorial-form-container .main-image-upload').css({--}}
    {{--                    'background-image': "url(" + result.successful[0].preview + ")",--}}
    {{--                    'border': "1px solid #acacac"--}}
    {{--                }).addClass('image-added')--}}

    {{--                $('.create-tutorial .create-tutorial-form-container .main-image-upload img').css('display', "none")--}}
    {{--                $('.create-tutorial .create-tutorial-form-container .main-image-upload #main_image').val(result.successful[0].response.body.filePath)--}}
    {{--            })--}}

    {{--            $('.create-tutorial .create-tutorial-form-container .main-image-upload').on('click', function () {--}}
    {{--                uppy.getPlugin('Dashboard').openModal()--}}
    {{--            })--}}
    {{--        })--}}
    {{--    </script>--}}
@endpush
