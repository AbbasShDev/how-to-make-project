@extends('layouts.app')

@push('css-links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container create-tutorial mb-5">
        <div class="create-tutorial-header py-5">
            <h2>إنشاء مقالة: <strong>{{ $title }}</strong></h2>
        </div>
        <div class="create-tutorial-form-container container">
            @include('_partials._display_errors')
            <form id="create-tutorial-form" action="{{ route('article.store') }}" method="post">
                @csrf
                <input type="hidden" name="title" value="{{ request('title') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="main_image" style="font-size: 18px">الصورة الرئيسية<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div class="main-image-upload @if(old("main_image")) image-added @endif" @if(old("main_image")) style="background-image: url('https://tusd.tusdemo.net/{{ old("main_image") }}');border : 1px solid #acacac" @endif>
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="main_image" id="main_image" value="{{ old("main_image") }}" hidden>
                            <img src="{{ asset('images/image-add-icon-colord.png') }}" alt="image add icon" @if(old("main_image")) style="display: none" @endif>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description" style="font-size: 18px">الوصف</label>
                            <textarea class="form-control" id="description" name="description" placeholder="صف الإرشادات الخاص بك في بضع جمل." style="height: 137px !important;">{{ old("description") }}</textarea>
                        </div>
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

                <hr class="custom-doted-hr">
                <div class="form-group">
                    <textarea class="form-control article" id="article" name="article" dir="rtl">{{ old("article") }}</textarea>
                </div>

                <div class="bottom-save-bar row m-0 align-items-center">
                    <button type="submit" class="save-btn">حفظ</button>
                    <button type="button" class="cancel-btn">إلغاء</button>
                    <span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="<h6 class='text-right' >عام:</h5><p>سيكون مرئي للجميع</p><h6 class='text-right'>خاص:</h5><p>سيكون مرئي لك فقظ</p>">
                        <i class="fas fa-question-circle fa-fw"></i>
                    </span>
                    <div class="form-group row m-0">
                        <div class="col-9 p-0">
                            <select class="form-control" id="article_status" name="article_status">
                                <option value="public" selected>عام</option>
                                <option value="private">خاص</option>
                            </select>
                        </div>
                        <label class="col-3 col-form-label px-0" for="article_status">الحالة</label>
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
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}" defer></script>
    <script>
        $(function () {

            CKEDITOR.replace('article',{
                language: 'ar',
                contentsLangDirection: 'rtl',
                height: 400,
            });
        })
    </script>
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
                })
                .use(Uppy.ImageEditor, {
                    target: Uppy.Dashboard,
                    quality: 0.8
                })
                .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

            uppy.on('file-added', (file) => {
                console.log('Added file', file)
            })

            uppy.on('complete', (result) => {
                $('.create-tutorial .create-tutorial-form-container .main-image-upload').css({
                    'background-image': "url("+ result.successful[0].preview +")",
                    'border' : "1px solid #acacac"
                }).addClass('image-added')

                $('.create-tutorial .create-tutorial-form-container .main-image-upload img').css('display', "none")
                $('.create-tutorial .create-tutorial-form-container .main-image-upload #main_image').val(result.successful[0].response.uploadURL.split("/").splice(3, 4).join("/"))
            })

            $('.create-tutorial .create-tutorial-form-container .main-image-upload').on('click', function (){
                uppy.getPlugin('Dashboard').openModal()
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
