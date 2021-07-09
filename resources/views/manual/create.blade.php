@extends('layouts.app')

@push('css-links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container create-tutorial mb-5">
        <div class="create-tutorial-header py-5">
            <h2>إنشاء كتيب: <strong>{{ $title }}</strong></h2>
        </div>
        <div class="create-tutorial-form-container container">
            @include('_partials._display_errors')
            <form id="create-tutorial-form" action="{{ route('manual.store') }}" method="post">
                @csrf
                <input type="hidden" name="title" value="{{ request('title') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="logo" style="font-size: 18px">الشعار<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div class="main-image-upload logo @if(old("logo")) image-added @endif" @if(old("logo")) style="background-image: url('https://tusd.tusdemo.net/{{ old("logo") }}');border : 1px solid #acacac" @endif>
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="logo" id="logo" value="{{ old("logo") }}" hidden>
                            <img src="{{ asset('images/image-add-icon-colord.png') }}" alt="image add icon" @if(old("logo")) style="display: none" @endif>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="banner" style="font-size: 18px">الصورة الرئيسية<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div class="main-image-upload main-image @if(old("banner")) image-added @endif" @if(old("banner")) style="background-image: url('https://tusd.tusdemo.net/{{ old("banner") }}');border : 1px solid #acacac" @endif>
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="banner" id="banner" value="{{ old("banner") }}" hidden>
                            <img src="{{ asset('images/image-add-icon-colord.png') }}" alt="image add icon" @if(old("banner")) style="display: none" @endif>
                        </div>
                    </div>
                </div>

                <hr class="custom-doted-hr">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description" style="font-size: 18px">الوصف</label>
                            <textarea class="form-control" id="description" name="description" placeholder="صف الإرشادات الخاص بك في بضع جمل." style="height: 137px !important;">{{ old("description") }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="tags" style="font-size: 18px">التصنيفات<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="افصل كل كلمة رئيسية بفاصلة (,) (على سبيل المثال: خشب , معدن , طباعة ثلاثية الأبعاد , إلخ.) <br> او اضغط (enter) بعد كتابة كل جملة">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                            <p>
                                <select class="form-control js-example-tokenizer select2-hidden-accessible" name="tags[]" id="tags" multiple="" data-select2-id="select2-data-10-wfcs" tabindex="-1" aria-hidden="true" style="width: 100%">
                                </select>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bottom-save-bar row m-0 align-items-center">
                    <button type="submit" class="save-btn">حفظ</button>
                    <button type="button" class="cancel-btn">إلغاء</button>
                    <span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="<h6 class='text-right' >عام:</h5><p>سيكون مرئي للجميع</p><h6 class='text-right'>خاص:</h5><p>سيكون مرئي لك فقظ</p>">
                        <i class="fas fa-question-circle fa-fw"></i>
                    </span>
                    <div class="form-group row m-0">
                        <div class="col-9 p-0">
                            <select class="form-control" id="manual_status" name="manual_status">
                                <option value="public" selected>عام</option>
                                <option value="private">خاص</option>
                            </select>
                        </div>
                        <label class="col-3 col-form-label px-0" for="manual_status">الحالة</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js-scripts')
    <script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>
    <script src="https://releases.transloadit.com/uppy/locales/v1.20.1/ar_SA.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script>
        $(function () {
            var uppy = Uppy.Core({
                restrictions: {
                    maxFileSize: 5500000,
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1,
                    allowedFileTypes: ['image/*']
                },
                locale: Uppy.locales.ar_SA
            })
                .use(Uppy.Dashboard,{
                    note: "يفضل التنسيق الأفقي (مثل 800 × 600 بكسل)",
                    showRemoveButtonAfterComplete: true,
                })
                .use(Uppy.ImageEditor, {
                    target: Uppy.Dashboard,
                    quality: 0.8
                })
                .use(Uppy.XHRUpload, {
                    endpoint: "{{ route('upload.uppy.files') }}",
                    formData: true,
                    fieldName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })

            uppy.on('complete', (result) => {
                $('.create-tutorial .create-tutorial-form-container .main-image-upload.logo').css({
                    'background-image': "url("+ result.successful[0].preview +")",
                    'border' : "1px solid #acacac"
                }).addClass('image-added')

                $('.create-tutorial .create-tutorial-form-container .main-image-upload.logo img').css('display', "none")
                $('.create-tutorial .create-tutorial-form-container .main-image-upload.logo #logo').val(result.successful[0].response.body.filePath)
            })

            $('.create-tutorial .create-tutorial-form-container .main-image-upload.logo').on('click', function (){
                uppy.getPlugin('Dashboard').openModal()
            })
        })
    </script>

    <script>
        $(function () {
            var uppy2 = Uppy.Core({
                restrictions: {
                    maxFileSize: 5500000,
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1,
                    allowedFileTypes: ['image/*']
                },
                locale: Uppy.locales.ar_SA
            })
                .use(Uppy.Dashboard,{
                    note: "يفضل التنسيق الأفقي (مثل 800 × 600 بكسل)",
                    showRemoveButtonAfterComplete: true,
                })
                .use(Uppy.ImageEditor, {
                    target: Uppy.Dashboard,
                    quality: 0.8
                })
                .use(Uppy.XHRUpload, {
                    endpoint: "{{ route('upload.uppy.files') }}",
                    formData: true,
                    fieldName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })

            uppy2.on('complete', (result) => {
                $('.create-tutorial .create-tutorial-form-container .main-image-upload.main-image').css({
                    'background-image': "url("+ result.successful[0].preview +")",
                    'border' : "1px solid #acacac"
                }).addClass('image-added')

                $('.create-tutorial .create-tutorial-form-container .main-image-upload.main-image img').css('display', "none")
                $('.create-tutorial .create-tutorial-form-container .main-image-upload.main-image #banner').val(result.successful[0].response.body.filePath)
            })

            $('.create-tutorial .create-tutorial-form-container .main-image-upload.main-image').on('click', function (){
                uppy2.getPlugin('Dashboard').openModal()
            })
        })
    </script>
    <script>
        $(function () {
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                width: '100%',
                placeholder: "افصل الكلمات بفاصلة (,)",
                allowClear: true
            })

            @if(old("tags"))
            function convertObjectToSelectOptions(obj){
                var htmlTags = '';
                for (var tag in obj){
                    htmlTags += '<option value="'+tag+'" selected="selected">'+obj[tag]+'</option>';
                }
                return htmlTags;
            }
            var tags = {};

            @foreach(old("tags") as $tag)
            Object.assign(tags, {"{{ $tag }}": "{{ $tag }}"});

            @endforeach

            $('.js-example-tokenizer').html(convertObjectToSelectOptions(tags)).trigger('change');
            @endif
        })
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
