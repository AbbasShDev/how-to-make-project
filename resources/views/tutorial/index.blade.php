@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header py-5">
            <h2>إنشاء إرشادات: <strong>{{ $title }}</strong></h2>
        </div>
        <div>
            <form action="">
                <div class="row">
                    <div class="col-md-4">
                        //TODO page Main picture
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
                                    <label for="tags" style="font-size: 18px">التصنيفات</label>
                                    <p>
                                        <select class="form-control js-example-tokenizer select2-hidden-accessible" name="tags" id="tags" multiple="" data-select2-id="select2-data-10-wfcs" tabindex="-1" aria-hidden="true" style="width: 100%">
                                        </select>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
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
@endsection
