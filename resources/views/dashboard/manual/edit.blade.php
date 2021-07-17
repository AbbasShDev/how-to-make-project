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


        .manual-tutorials-container .tutorials-container .single-tutorial {
            position: relative;
        }

        .manual-tutorials-container .tutorials-container .single-tutorial .handle {
            width: 2px !important;
            opacity: 0.4;
            cursor: move;
            background-image: url(http://demo.dokit.io/w/extensions/PageForms/skins/rearrangeDots.png);
            background-repeat: repeat;
            max-width: 2px !important;
            padding-left: 0 !important;
            padding-right: 9px !important;
            transition: opacity .3s ease-in-out;
        }
        .manual-tutorials-container .tutorials-container .single-tutorial .handle:hover {
            opacity: 1;
        }
        .manual-tutorials-container .tutorials-container .single-tutorial .remove-tutorial {
            position: absolute;
            cursor: pointer;
            left: -9px;
            top: -10px;
            font-size: 20px;
            opacity: 0;
            transition: opacity .3s ease-in-out;
        }

        .manual-tutorials-container .tutorials-container .single-tutorial:hover .remove-tutorial {
            opacity: 1;
        }
        .manual-tutorials-container .add-tutorial-btn {
            outline: none !important;
            border: none !important;
            border-radius: 5px;
            font-size: 1.25em;
            padding: 12px 15px;
            background-color: #52bad5;
            color: #ffffff;
            transition: all .3s ease-in-out;
        }
        .manual-tutorials-container .add-tutorial-btn:hover {
            background-color: #2c9ab7;
        }

        .create-tutorial .bottom-save-bar {
            position: fixed;
            width: 100%;
            height: 55px;
            background-color: #30373B;
            left: 0px;
            bottom: 0px;
            padding: 10px 15px;
            z-index: 1005 !important;
        }

    </style>
@endpush

@section('content')
    <form id="create-tutorial-form" class="create-tutorial" action="{{ route('dashboard.manual.update', $manual) }}"
          method="post">
        <div class="container mb-5">
            <h2 class="px-3 d-lg-flex">
                <div style="line-height: 1.4 !important;">تعديل كتيب:</div>
                <div class="form-group col-lg-5 m-0 p-0 pr-lg-2">
                    <input class="form-control form-control-lg mt-2 mt-lg-0" id="title" type="text" name="title" value="{{ old('title') ? old('title') : $manual->title }}">
                </div>
            </h2>
            <hr class="custom-doted-hr">
            <div class="create-tutorial-form-container container">
                @include('_partials._display_errors')
                @csrf
                @method("PUT")
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="logo" style="font-size: 18px">الشعار<span
                                class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip"
                                data-html="true" data-placement="top"
                                data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div
                            class="main-image-upload logo image-added"
                            style="background-image: @if(old("logo"))  url('{{ presentImage(old("logo")) }}') @else url('{{ presentImage($manual->logo) }}')  @endif;border : 1px solid #acacac"
                        >
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="logo" id="logo"
                                   value="{{ old("logo") ? old("logo") : $manual->logo }}" hidden>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="banner" style="font-size: 18px">الصورة الرئيسية<span
                                class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip"
                                data-html="true" data-placement="top"
                                data-original-title="يفضل التنسيق الأفقي (مثل 800 × 600 بكسل).<br/> يمكن تعديل الصورة بعد اضافتها.">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                        <div
                            class="main-image-upload main-image image-added"
                            style="background-image: @if(old("banner"))  url('{{ presentImage(old("banner")) }}') @else url('{{ presentImage($manual->banner) }}')  @endif;border : 1px solid #acacac"
                        >
                            <div class="overlay"></div>
                            <p class="font-head"><i class="fas fa-edit fa-fw"></i> تغير الصورة</p>
                            <input type="text" name="banner" id="banner"
                                   value="{{ old("banner") ? old("banner") : $manual->banner }}" hidden>
                        </div>
                    </div>
                </div>

                <hr class="custom-doted-hr">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description" style="font-size: 18px">الوصف</label>
                            <textarea class="form-control" id="description" name="description"
                                      placeholder="صف الإرشادات الخاص بك في بضع جمل."
                                      style="height: 137px !important;">{{ old("description") ? old("description") : $manual->description }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="tags" style="font-size: 18px">التصنيفات<span
                                    class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip"
                                    data-html="true" data-placement="top"
                                    data-original-title="افصل كل كلمة رئيسية بفاصلة (,) (على سبيل المثال: خشب , معدن , طباعة ثلاثية الأبعاد , إلخ.) <br> او اضغط (enter) بعد كتابة كل جملة">
                                           <i class="fas fa-question-circle fa-fw"></i>
                                        </span></label>
                            <p>
                                <select class="form-control js-example-tokenizer select2-hidden-accessible"
                                        name="tags[]" id="tags" multiple="" data-select2-id="select2-data-10-wfcs"
                                        tabindex="-1" aria-hidden="true" style="width: 100%">
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="custom-doted-hr">
                <div class="manual-tutorials-container">
                    <div id="tutorials" class="tutorials-container">
                        <div  class="single-tutorial row rounded-lg justify-content-start bg-white px-2 pb-3 my-4">
                            <i class="fas fa-times-circle remove-tutorial"></i>
                            <div class="col-1 handle ml-3 ml-md-0 mr-0 mt-3"></div>
                            <div class="col-11 p-0 pt-3">
                                <div class="show-tutorial-title pr-3">من وتم استمرار وباستثناء. أما عن بأيدي مشاركة</div>
                                <input type="text" name="tutorial_order" class="tutorial-order" hidden>
                                <input type="text" name="tutorial_title"  class="form-control tutorial-title" value="من وتم استمرار وباستثناء. أما عن بأيدي مشاركة" hidden>
                            </div>
                        </div>
                        <div  class="single-tutorial row rounded-lg justify-content-start bg-white px-2 pb-3 my-4">
                            <i class="fas fa-times-circle remove-tutorial"></i>
                            <div class="col-1 handle ml-3 ml-md-0 mr-0 mt-3"></div>
                            <div class="col-11 p-0 pt-3">
                                <div class="show-tutorial-title pr-3">من وتم استمرار وباستثناء. أما عن بأيدي مشاركة2</div>
                                <input type="text" name="tutorial_order" class="tutorial-order"  hidden>
                                <input type="text" name="tutorial_title"  class="form-control tutorial-title" value="من وتم استمرار وباستثناء. أما عن بأيدي مشاركة2" hidden>
                            </div>
                        </div>
                        <div  class="single-tutorial row rounded-lg justify-content-start bg-white px-2 pb-3 my-4">
                            <i class="fas fa-times-circle remove-tutorial"></i>
                            <div class="col-1 handle ml-3 ml-md-0 mr-0 mt-3"></div>
                            <div class="col-11 p-0 pt-3">
                                <div class="show-tutorial-title pr-3">من وتم استمرار وباستثناء. أما عن بأيدي مشاركة3</div>
                                <input type="text" name="tutorial_id" class="tutorial-order" hidden>
                                <input type="text" name="tutorial_order" class="tutorial-order" hidden>
                                <input type="text" name="tutorial_title"  class="form-control tutorial-title" value="من وتم استمرار وباستثناء. أما عن بأيدي مشاركة3" hidden>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-center mb-5">
                        <button type="button" class="add-tutorial-btn" data-toggle="modal" data-target="#addTutorialModal"><i class="fa fa-plus fa-fw"></i> إضافة إرشادات</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-save-bar row m-0 align-items-center">
            <button type="submit" class="save-btn">حفظ</button>
            <button type="button" class="cancel-btn">إلغاء</button>
            <span class="custom-tooltip rounded-circle" type="button" data-toggle="tooltip" data-html="true"
                  data-placement="top"
                  data-original-title="<h6 class='text-right' >عام:</h5><p>سيكون مرئي للجميع</p><h6 class='text-right'>خاص:</h5><p>سيكون مرئي لك فقظ</p>">
                        <i class="fas fa-question-circle fa-fw"></i>
                    </span>
            <div class="form-group row m-0">
                <div class="col-9 p-0">
                    <select class="form-control" id="article_status" name="article_status">
                        <option value="public"
                                @if( old("article_status") == "public" ) selected
                                @elseif($manual->manual_status == "public") selected @endif >
                            عام
                        </option>
                        <option value="private"
                                @if( old("article_status") == "private" ) selected
                                @elseif($manual->manual_status == "private") selected @endif >
                            خاص
                        </option>
                    </select>
                </div>
                <label class="col-3 col-form-label px-0" for="article_status">الحالة</label>
            </div>
        </div>
    </form>

    <div class="modal fade create-modal" id="addTutorialModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">قم بإختيار إرشادات لاضافتها</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="multiple-select">الإرشادات</label>
                        <div class="col-md-9">
                            <select class="form-control" id="multiple-select" name="multiple-select" size="5" multiple="">
                                @foreach($tutorials as $tutorial)
                                    <option value="{{ $tutorial->id }}" data-title="{{ $tutorial->title }}">{{ $tutorial->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button class="btn btn-info" type="button">حفظ</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">الغاء</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js-scripts')
    <script src="https://releases.transloadit.com/uppy/v1.29.1/uppy.min.js"></script>
    <script src="https://releases.transloadit.com/uppy/locales/v1.20.1/ar_SA.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js" defer></script>
    <script>
        $(function () {

            $('#tutorials').sortable({
                group: 'list',
                animation: 200,
                handle: '.handle',
                onSort: function (/**Event*/evt) {
                    setTutorialsValues()
                },
            });


            $('.manual-tutorials-container .tutorials-container').on('click', '.single-tutorial .remove-tutorial', function () {
                if (confirm('هل تريد حذف الخطوة')){
                    $(this).parent().fadeOut(300, function(){
                        $(this).remove()
                        setTutorialsValues()
                    })

                }
            })

            function setTutorialsValues() {
                $('#tutorials .single-tutorial').each(function (index) {

                    $(this).find('.tutorial-order').val(index + 1)
                    $(this).find('.tutorial_id').attr('name', `tutorials[${index}][tutorial_id]`)
                    $(this).find('.tutorial-order').attr('name', `tutorials[${index}][tutorial_order]`)
                    $(this).find('.tutorial-title').attr('name', `tutorials[${index}][tutorial_title]`)

                })
            }


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

            function convertObjectToSelectOptions(obj) {
                var htmlTags = '';
                for (var tag in obj) {
                    htmlTags += '<option value="' + tag + '" selected="selected">' + obj[tag] + '</option>';
                }
                return htmlTags;
            }

            var tags = {};

            @if(old("tags"))
            @foreach(old("tags") as $tag)
            Object.assign(tags, {"{{ $tag }}": "{{ $tag }}"});
            @endforeach
            $('.js-example-tokenizer').html(convertObjectToSelectOptions(tags)).trigger('change');
            @elseif($manual->tags )
            @foreach($manual->tags as $tag)
            Object.assign(tags, {"{{ $tag->name }}": "{{ $tag->name }}"});
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
