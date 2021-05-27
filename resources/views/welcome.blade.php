@extends('layouts.welcome')

@section('content')
    <section class="all-in-one text-center">
        <div class="container">
            <h1>منصة الكل في واحد</h1>
            <p class="pt-3">يسمح لك <strong>وثقها</strong> بإدارة أدلة المستخدم الرقمية من الألف إلى الياء.</p>
            <div class="row justify-content-center pt-4">
                <div
                    class="all-in-one-btn mx-2 active-all-in-one-btn"
                    data-title="أنشأ بسهولة"
                    data-body="لا يتطلب الأمر سوى بضع نقرات لإنشاء أدلة وإرشادات من خلال ميزات التحرير."
                    data-img="{{ asset('images/create_illustration.svg') }}"
                >
                    أنشأ
                </div>
                <div
                    class="all-in-one-btn mx-2"
                    data-title="تنظيم بكفاءة"
                    data-body="وثقها يجعل من السهل تنظيم المحتوى والتحكم فيه: التصنيف ، ووضع العلامات ، والبيانات الوصفية."
                    data-img="{{ asset('images/organize_illustration.svg') }}"
                >
                    نظم
                </div>
                <div
                    class="all-in-one-btn mx-2"
                    data-title="شارك في كل مكان"
                    data-body="تتوفر الأدلة والإرشادات الخاصة بك على جميع الأجهزة: أجهزة الكمبيوتر الشخصية ، والهواتف الذكية ، والجهاز اللوحي ، وأي جهاز يدعم ملفات PDF."
                    data-img="{{ asset('images/share_illustration.svg') }}"
                >
                    شارك
                </div>
            </div>
            <div class="row justify-content-between pt-5 panel">
                <div class="col-lg-6 text-left d-flex flex-column align-content-center h-100 panel-right">
                    <h1 class="panel-title">أنشأ بسهولة</h1>
                    <p  class="pt-3 panel-body">لا يتطلب الأمر سوى بضع نقرات لإنشاء أدلة وإرشادات من خلال ميزات التحرير.</p>
                </div >
                <div class="col-lg-6">
                    <img class="panel-img img-fluid" style="width: 420px!important;" src="{{ asset('images/create_illustration.svg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-scripts')
    <script>
        $(function() {
            $('.all-in-one .all-in-one-btn').each(function (index) {
                let panelTitle = $('.panel .panel-title')
                let panelBody = $('.panel .panel-body')
                let panelImg = $('.panel .panel-img')

                $(this).on('click', function () {

                    $(this).addClass('active-all-in-one-btn').siblings().removeClass('active-all-in-one-btn')

                    panelTitle.text('').text($(this).data('title'))
                    panelBody.text('').text($(this).data('body'))
                    panelImg.attr("src",$(this).data('img'));
                })
            })
        });

    </script>
@endsection
