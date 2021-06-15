@extends('layouts.app')

@push('css-links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container create-tutorial mb-5">
        <div class="create-tutorial-header py-5">
            <h2>إنشاء إرشادات: <strong>{{ $title }}</strong></h2>
        </div>
        <div class="create-tutorial-form-container container">
            @include('_partials._display_errors')
            <form id="create-tutorial-form" action="{{ route('tutorial.store') }}" method="post">
                @csrf
                <input type="hidden" name="title" value="{{ request('title') }}">
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
                                    <label for="duration" style="font-size: 18px">المدة</label>
                                    <div class="input-group">
                                        <input class="form-control" id="duration" type="number" name="duration" required>
                                        <div class="input-group-append">
                                            <select class="form-control" id="duration_measurement" name="duration_measurement" style="border-bottom-right-radius: 0 !important; border-top-right-radius: 0 !important;" required >
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
                                        <select class="form-control js-example-tokenizer select2-hidden-accessible" name="tags[]" id="tags" multiple="" data-select2-id="select2-data-10-wfcs" tabindex="-1" aria-hidden="true" style="width: 100%">
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
                    <textarea class="form-control introduction" id="introduction" name="introduction" dir="rtl"></textarea>
                </div>

                <div class="form-group">
                    <label for="introduction_video" style="font-size: 27px">فيديو (يوتيوب) للمقدمة <span class="text-muted" style="font-size: 15px !important;">(اختياري)</span></label>
                    <input type="text" id="introduction_video" name="introduction_video" class="form-control" placeholder="أدخل عنوان URL لفيديو يوتيوب">
                </div>

                <hr class="custom-doted-hr">
                <div id="steps" class="steps-container">
                    <div class="single-step row rounded-lg justify-content-between bg-white px-2 pb-3 my-4">
                        <i class="fas fa-times-circle remove-step"></i>
                        <div class="col-1 handle ml-3 ml-md-0 mr-0 mt-3"></div>
                        <div class="col-lg-5 p-0 pt-3 left-single-step">
                            <div id="step-1-images-container" class="step-images-container" data-steporder=""></div>
                        </div>
                        <div class="col-lg-6 p-0 pt-3">
                            <input type="text" name="" class="step-order" hidden>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text step-title-order">الخطوة 1</span>
                                    </div>
                                    <input type="text" name="" placeholder="عنوان الخطوة" class="form-control step-title">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control step-content" name="" dir="rtl"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center mb-5">
                    <button type="button" class="add-step-btn"><i class="fa fa-plus fa-fw"></i> إضافة خطوة</button>
                </div>

                <div class="bottom-save-bar row m-0 align-items-center">
                    <button type="submit" class="save-btn">حفظ</button>
                    <button type="button" class="cancel-btn">إلغاء</button>
                    <span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true" data-placement="top" data-original-title="<h6 class='text-right' >عام:</h5><p>سيكون مرئي للجميع</p><h6 class='text-right'>خاص:</h5><p>سيكون مرئي لك فقظ</p>">
                        <i class="fas fa-question-circle fa-fw"></i>
                    </span>
                    <div class="form-group row m-0">
                        <div class="col-9 p-0">
                            <select class="form-control" id="tutorial_status" name="tutorial_status">
                                <option value="public" selected>عام</option>
                                <option value="private">خاص</option>
                            </select>
                        </div>
                        <label class="col-3 col-form-label px-0" for="tutorial_status">الحالة</label>
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
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js" defer></script>
    <script>
        $(function () {

            CKEDITOR.replace('introduction',{
                language: 'ar',
                contentsLangDirection: 'rtl',
                toolbar : [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'insert', items: [ 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', ] },
                    { name: "paragraph", items: ["NumberedList", "BulletedList"] },
                    { name: 'links', items: [ 'Link', 'Unlink' ] },
                ],
            });


            setStepsValues()
            initializeUppyForSteps(`#step-1-images-container`)

            $('#steps').sortable({
                group: 'list',
                animation: 200,
                handle: '.handle',
                onSort: function (/**Event*/evt) {
                    setStepsValues()
                },
            });
        })

        $('.create-tutorial .create-tutorial-form-container .add-step-btn').on('click', function () {

            let stepCount = $('#steps .single-step').length +1;

            $(`<div class="single-step row rounded-lg justify-content-between bg-white px-2 pb-3 my-4">
                        <i class="fas fa-times-circle remove-step"></i>
                        <div class="col-1 handle ml-3 ml-md-0 mr-0 mt-3"></div>
                        <div class="col-lg-5 p-0 pt-3 left-single-step">
                            <div id="step-${stepCount}-images-container" class="step-images-container" data-steporder=""></div>
                        </div>
                        <div class="col-lg-6 p-0 pt-3">
                            <input type="text" name="" class="step-order" hidden>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text step-title-order">الخطوة 1</span>
                                    </div>
                                    <input type="text" name="" placeholder="عنوان الخطوة" class="form-control step-title">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control step-content" name="" dir="rtl"></textarea>
                            </div>
                        </div>
                </div>`)
                .hide()
                .appendTo('#steps')
                .slideDown()

            setStepsValues()
            initializeUppyForSteps(`#step-${stepCount}-images-container`)

        })

        $('.create-tutorial .create-tutorial-form-container .steps-container').on('click', '.single-step .remove-step', function () {
            if (confirm('هل تريد حذف الخطوة')){
                $(this).parent().fadeOut(300, function(){
                    $(this).remove()
                    setStepsValues()
                })

            }
        })
        function setStepsValues() {
            $('#steps .single-step').each(function (index) {
                $(this).find('.step-title-order').text("الخطوة " + (index + 1) )

                $(this).find('.step-order').val(index + 1)
                $(this).find('.step-order').attr('name', `steps[${index}][step_order]`)
                $(this).find('.step-title').attr('name', `steps[${index}][step_title]`)
                $(this).find('.step-content').attr('name', `steps[${index}][step_content]`)
                $(this).find('.step-images-container').data('steporder', `steps[${index}][step_images]`);
                $(this).find('.step-images-container input').each(function (indexinput) {
                    $(this).attr('name', `steps[${index}][step_images][${indexinput}]`);
                })

                StepsCKEditorChange(`steps[${index}][step_content]`);
            })
        }

        function StepsCKEditorChange(TextareaName) {
            CKEDITOR.replace(TextareaName,{
                extraPlugins: ['divarea', 'liststyle'],
                height: 225,
                language: 'en',
                contentsLangDirection: 'ltr',
                toolbar : [
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'insert', items: [  'Table' ] },
                    { name: "paragraph", items: ["NumberedList", "BulletedList"] },
                    { name: 'links', items: [ 'Link' ] },
                ],
            });
        }

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

        function initializeUppyForSteps(target){
                var StepsUppy = Uppy.Core({
                    restrictions: {
                        maxFileSize: 5500000,
                        maxNumberOfFiles: 6,
                        minNumberOfFiles: 0,
                        allowedFileTypes: ['image/*']
                    },
                    locale: Uppy.locales.ar_SA,
                })
                .use(Uppy.Dashboard, {
                    inline: true,
                    height: 350,
                    target: target,
                    doneButtonHandler:null,
                    showRemoveButtonAfterComplete: true,
                    note: "يفضل التنسيق الأفقي (مثل 800 × 600 بكسل)",
                })
                .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})


                StepsUppy.on('complete', (result) => {

                    console.log('Upload complete! We’ve uploaded these files:', result.successful)

                    for (let i = 0; i < result.successful.length; i++){

                        let j;
                        if ($(target).find('input').length > 0 ){
                            j =  $(target).find('input').length
                        }else{
                            j = i
                        }

                        $('<input>').attr({
                            type: 'hidden',
                            name: $(target).data('steporder') + `[${j}]`,
                            id: result.successful[i].id,
                            value:  result.successful[i].response.uploadURL.split("/").splice(3, 4).join("/")
                        }).appendTo(target);

                        j++
                    }
                })

                StepsUppy.on('file-removed', (file, reason) => {
                    $(target).find('input').each(function (index) {
                       if ($(this).attr('id') == file.id){
                           $(this).remove()
                       }
                    })

                    $(target).find('input').each(function (index) {
                        $(this).attr('name',  $(target).data('steporder') + `[${index}]`)
                    })
                    console.log(file)
                    console.log(reason)
                })

        }
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
        })
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
