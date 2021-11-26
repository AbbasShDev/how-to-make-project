@extends('layouts.dashboard')

@push('css-links')

@endpush

@section('content')
    <h3>كل الكتيبات</h3>
    <hr class="custom-doted-hr">
    <table class="table table-responsive-sm table-bordered table-striped bg-white text-center">
        <thead>
        <tr>
            <th>#</th>
            <th>الشعار</th>
            <th style="width:500px !important;min-width: 85.5px !important;">العنوان</th>
            <th>الحالة</th>
            <th style="width: 118px !important;min-width: 118px !important;max-width: 118px !important;">تعديبل | حذف
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($manuals as $manual)
            <tr>
                <td>{{ substr($manual->uuid, -10) }}</td>
                <td><img class="rounded-lg" height="34" src="{{ presentImage($manual->logo) }}" alt="main image"></td>
                <td><a href="{{ route("manual.show",$manual ) }}">{{ $manual->title }}</a></td>
                <td>
                    @if($manual->manual_status === "private")
                        <span class="badge badge-warning">خاص</span>
                    @else
                        <span class="badge badge-info">عام</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.manual.edit', $manual) }}"
                       class="btn btn-sm btn-success my-1">تعديبل</a>
                    <form action="{{ route("dashboard.manual.destroy", $manual) }}" method="post"
                          class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="حذف" onclick="return confirm('هل انت متاكد من الحذف؟')"
                               class="btn btn-sm btn-danger my-1">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center bg-white">
                    لايوجد كتيبات خاصة بك لعرضها
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection

@push('js-scripts')

@endpush
