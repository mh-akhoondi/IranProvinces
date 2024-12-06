// Resources/views/cities/create.blade.php
@extends('admin.layouts.app')

@section('title', 'افزودن شهر جدید')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">افزودن شهر جدید</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cities.store') }}" method="POST" id="city-form">
                        @csrf

                        {{-- انتخاب استان --}}
                        <div class="form-group">
                            <label for="province_id">استان <span class="text-danger">*</span></label>
                            <select name="province_id" 
                                    id="province_id" 
                                    class="form-control select2 @error('province_id') is-invalid @enderror" 
                                    required>
                                <option value="">انتخاب کنید</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" 
                                            {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('province_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- نام شهر --}}
                        <div class="form-group">
                            <label for="name">نام شهر <span class="text-danger">*</span></label>
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
                                <label class="custom-control-label" for="is_active">شهر فعال باشد</label>
                            </div>
                        </div>

                        {{-- دکمه‌های فرم --}}
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save ml-1"></i>
                                ذخیره
                            </button>
                            <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // راه‌اندازی Select2 برای انتخاب استان
            $('.select2').select2({
                placeholder: "انتخاب کنید",
                language: "fa",
                dir: "rtl"
            });

            // اعتبارسنجی فرم
            $("#city-form").validate({
                rules: {
                    province_id: {
                        required: true
                    },
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    }
                },
                messages: {
                    province_id: {
                        required: "لطفاً استان را انتخاب کنید"
                    },
                    name: {
                        required: "لطفاً نام شهر را وارد کنید",
                        minlength: "نام شهر باید حداقل 2 کاراکتر باشد",
                        maxlength: "نام شهر نمی‌تواند بیشتر از 255 کاراکتر باشد"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                }
            });
        });
    </script>
@endpush