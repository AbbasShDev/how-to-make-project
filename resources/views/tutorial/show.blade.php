@extends('layouts.app')

@push('css-links')

@endpush

@push('css-additional-styles')
    <style>
        body {
            background-color: #ffffff !important;
        }
    </style>
@endpush
@section('content')
    <div class="container mt-2 mb-5">
        <h1>{{ $tutorial->title }}</h1>
        <p><i class="fas fa-user-circle fa-fw"></i>
            الكاتب:
            <a href="">{{ $tutorial->user->name }}</a>
             |
            <i class="fas fa-pen-square fa-fw"></i>
            آخر تعديل:
            {{ $tutorial->updated_at->format('d/m/Y') }}
        </p>
        <hr class="col-4 p-0 custom-doted-hr">

    </div>
@endsection

@push('js-scripts')

@endpush
