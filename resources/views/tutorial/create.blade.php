@extends('layouts.app')

@push('css-links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container create-tutorial">
        <div class="create-tutorial-header py-5">
            <h2>إنشاء إرشادات: <strong>{{ $title }}</strong></h2>
        </div>
        <div class="create-tutorial-form-container">
            <form action="">
                <div class="row">
                    <div class="col-md-4">
                        <label for="main_image" style="font-size: 18px">الصورة الرئيسية<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div class="main-image-upload">
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="main_image" id="main_image" value="" hidden>
                            <img src="{{ asset('images/image-add-icon-colord.png') }}" alt="image add icon">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="description" style="font-size: 18px">الوصف</label>
                            <textarea class="form-control" id="description" placeholder="صف الإرشادات الخاص بك في بضع جمل." required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="difficulty" style="font-size: 18px">الصعوبة</label>
                                    <select class="form-control" id="difficulty" name="difficulty" required>
                                        <option value="" selected disabled></option>
                                        <option value="سهل جداً">سهل جداً</option>
                                        <option value="سهل">سهل</option>
                                        <option value="متوسط">متوسط</option>
                                        <option value="صعب">صعب</option>
                                        <option value="صعب جداً">صعب جداً</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="difficulty" style="font-size: 18px">المدة</label>
                                    <div class="input-group">
                                        <input class="form-control" id="difficulty" type="number" name="difficulty" required>
                                        <div class="input-group-append">
                                            <select class="form-control" id="difficulty_measurement" name="difficulty_measurement" style="border-bottom-right-radius: 0 !important; border-top-right-radius: 0 !important;" required >
                                                <option value="دقيقة/دقائق" selected>دقيقة/دقائق</option>
                                                <option value="ساعة/ساعات">ساعة/ساعات</option>
                                                <option value="يوم/أيام">يوم/أيام</option>
                                                <option value="شهر/شهور">شهر/شهور</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area" style="font-size: 18px">المجال</label>
                                    <select class="form-control" id="area" name="area" required>
                                        <option value="" selected disabled></option>
                                        <option value="الصيانة">الصيانة</option>
                                        <option value="الأمن">الأمن</option>
                                        <option value="الإنتاج">الإنتاج</option>
                                        <option value="إستخدامات">إستخدامات</option>
                                        <option value="أخرى">أخرى</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tags" style="font-size: 18px">التصنيفات<span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="افصل كل كلمة رئيسية بفاصلة (,) (على سبيل المثال: خشب , معدن , طباعة ثلاثية الأبعاد , إلخ.) <br> او اضغط (enter) بعد كتابة كل جملة">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                                    <p>
                                        <select class="form-control js-example-tokenizer select2-hidden-accessible" name="tags" id="tags" multiple="" data-select2-id="select2-data-10-wfcs" tabindex="-1" aria-hidden="true" style="width: 100%">
                                        </select>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr class="custom-doted-hr">
                <div class="form-group">
                    <label for="introduction" style="font-size: 27px">مقدمة <span class="text-muted" style="font-size: 15px !important;">(اختياري)</span></label>
                    <textarea class="form-control" id="introduction" name="introduction" dir="rtl"></textarea>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js-scripts')
    <script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>
    <script src="https://releases.transloadit.com/uppy/locales/v1.20.1/ar_SA.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js" defer></script>

    <script>
        $(document).ready(function(){
            $(".js-example-tokenizer").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                width: '100%',
                placeholder: "افصل الكلمات بفاصلة (,)",
                allowClear: true
            })
        })
    </script>
    <script>

        $(document).ready(function (){
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
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>>
    <script>
        $(function () {
            CKEDITOR.replace('introduction',{
                language: 'ar',
                contentsLangDirection: 'rtl',
                filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        })
    </script>>
@endpush
