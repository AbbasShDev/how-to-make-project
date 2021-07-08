@extends('layouts.dashboard')

@push('css-links')

@endpush

@section('content')
    <h3>كل المقالات</h3>
    <hr class="custom-doted-hr">
    <table class="table table-responsive-sm table-bordered table-striped bg-white text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>الصورة الرئيسية</th>
            <th style="width:500px !important;min-width: 85.5px !important;">العنوان</th>
            <th>الحالة</th>
            <th style="width: 118px !important;min-width: 118px !important;max-width: 118px !important;">تعديبل | حذف</th>
        </tr>
        </thead>
        <tbody>
        @forelse($articles as $article)
            <tr>
                <td>{{ substr($article->uuid, -10) }}</td>
                <td><img class="rounded-lg" height="34" src="{{ presentImage($article->main_image) }}" alt="main image"></td>
                <td>{{ $article->title }}</td>
                <td>
                    @if($article->article_status === "private")
                        <span class="badge badge-warning">خاص</span>
                    @else
                        <span class="badge badge-info">عام</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.article.edit', $article) }}" class="btn btn-sm btn-success my-1">تعديبل</a>
                    <form action="{{ route("dashboard.article.destroy", $article) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="حذف" onclick="return confirm('هل انت متاكد من الحذف؟')" class="btn btn-sm btn-danger my-1">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center bg-white">
                    لايوجد مقالات خاصة بك لعرضها
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection

@push('js-scripts')

@endpush
