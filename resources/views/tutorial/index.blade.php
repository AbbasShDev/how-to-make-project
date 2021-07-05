@extends('layouts.dashboard')

@push('css-links')

@endpush

@section('content')
    <h3>كل الإرشادات</h3>
    <hr class="custom-doted-hr">
    <table class="table table-responsive-lg table-bordered table-striped bg-white text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>الصورة الرئيسية</th>
            <th style="width: 375px !important;max-width: 375px !important;min-width: 282px !important;">العنوان</th>
            <th>عدد الخطوات</th>
            <th>الحالة</th>
            <th>تعديبل | حذف</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tutorials as $tutorial)
            <tr>
                <td>{{ substr($tutorial->uuid, -10) }}</td>
                <td><img class="rounded-lg" height="34" src="{{ presentImage($tutorial->main_image) }}" alt="main image"></td>
                <td>{{ $tutorial->title }}</td>
                <td>{{ $tutorial->steps_count }}</td>
                <td>
                    @if($tutorial->tutorial_status === "private")
                        <span class="badge badge-warning">خاص</span>
                    @else
                        <span class="badge badge-info">عام</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.tutorial.edit', $tutorial) }}" class="btn btn-sm btn-success my-1">تعديبل</a>
                    <form action="{{ route("dashboard.tutorial.destroy", $tutorial) }}" method="post" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="حذف" onclick="return confirm('هل انت متاكد من الحذف؟')" class="btn btn-sm btn-danger my-1">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center bg-white">
                    لايوجد إرشادات خاصة بك لعرضها
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection

@push('js-scripts')

@endpush
