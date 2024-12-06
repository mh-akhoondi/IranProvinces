// Resources/views/provinces/create.blade.php
@extends('admin.layouts.app')

@section('title', 'افزودن استان جدید')

@section('content')
    {{-- کارت اصلی فرم --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">افزودن استان جدید</h4>
                </div>
                <div class="card-body">
                    {{-- شروع فرم --}}
                    <form action="{{ route('admin.provinces.store') }}" method="POST" id="province-form">
                        @csrf

                        {{-- نام استان --}}
                        <div class="form-group">
                            <label for="name">نام استان <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- وضعیت فعال/غیرفعال --}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', 1) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">استان فعال باشد</label>
                            </div>
                        </div>

                        {{-- دکمه‌های فرم --}}
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save ml-1"></i>
                                ذخیره
                            </button>
                            <a href="{{ route('admin.provinces.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times ml-1"></i>
                                انصراف
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // اعتبارسنجی سمت کلاینت
        $(document).ready(function() {
            $("#province-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    }
                },
                messages: {
                    name: {
                        required: "لطفاً نام استان را وارد کنید",
                        minlength: "نام استان باید حداقل 2 کاراکتر باشد",
                        maxlength: "نام استان نمی‌تواند بیشتر از 255 کاراکتر باشد"
                    }
                }
            });
        });
    </script>
@endpush