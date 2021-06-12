<div class="modal fade create-modal" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">قم بإنشاء صفحة</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item mr-0 ml-2"><a class="tab-btn btn btn-outline-info active" data-toggle="tab" href="#" role="tab" data-formTitle="عنوان الإرشادات" data-formAction="{{ route('tutorial.create') }}" data-formDescription="قم بإنشاء إرشادات خطوة بخطوة لإكمال مهمة." ><i class="fa fa-list-ol fa-fw"></i> إرشادات</a></li>
                            <li class="nav-item mr-0 ml-2"><a class="tab-btn btn btn-outline-info" data-toggle="tab" href="#" role="tab" data-formTitle="عنوان المقالة" data-formAction="{{ route('article.create') }}" data-formDescription="قم بإنشاء مقالة."><i class="far fa-file-alt fa-fw"></i> مقالة</a></li>
                            <li class="nav-item mr-0 ml-2"><a class="tab-btn btn btn-outline-info" data-toggle="tab" href="#" role="tab" data-formTitle="عنوان الكتيب" data-formAction="/manual/create" data-formDescription="قم بإنشاء دليل لتجميع الإرشادات والمقالات الخاصة بك."><i class="fa fa-book fa-fw"></i> كتيب</a></li>
                        </ul>
                        <div class="tab-content border-0 pt-4 pb-0 px-0">
                            <div class="modal-create-info">
                                <i class="fas fa-info-circle fa-fw"></i>
                                <h6 class="d-inline-block">
                                    قم بإنشاء إرشادات خطوة بخطوة لإكمال مهمة.
                                </h6>
                                <form class="modal-create-form" action="{{ route('tutorial.create') }}" method="get">

                                    <div class="row">
                                        <div class="col-10">
                                            <input class="form-control title-input" type="text" name="title" placeholder="عنوان الإرشادات" required>
                                        </div>
                                        <div class="col-2 p-0">
                                            <button class="btn btn-info" type="submit">إنشاء</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
