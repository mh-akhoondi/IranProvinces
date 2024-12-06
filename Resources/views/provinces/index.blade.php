// Resources/views/provinces/index.blade.php
@extends('admin.layouts.app')

@section('title', 'مدیریت استان‌ها')

@push('styles')
    <link rel="stylesheet" href="{{ asset('modules/iranprovinces/css/provinces.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">لیست استان‌ها</h4>
                </div>
                <div class="card-body">
                    {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap w-100']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('modules/iranprovinces/js/provinces.js') }}"></script>
@endpush