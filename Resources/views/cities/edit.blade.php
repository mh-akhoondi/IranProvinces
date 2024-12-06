@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ویرایش شهر {{ $city->name }}</h4>
            </div>
            <div class="card-body">
                <form id="update-city-data" action="{{ route('cities.update', $city->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province_id">استان</label>
                                <select class="form-control select2" id="province_id" name="province_id" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($provinces as $id => $name)
                                        <option value="{{ $id }}" {{ $city->province_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">نام شهر</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_active">وضعیت</label>
                                <select class="form-control" id="is_active" name="is_active">
                                    <option value="1" {{ $city->is_active ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ !$city->is_active ? 'selected' : '' }}>غیرفعال</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">بروزرسانی</button>
                    <a href="{{ route('cities.index') }}" class="btn btn-secondary">انصراف</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // راه‌اندازی select2 برای انتخاب استان
    $('.select2').select2();

    // هندل کردن ارسال فرم با Ajax
    $('#update-city-data').on('submit', function(e) {
        e.preventDefault();
        const url = $(this).attr('action');
        const data = $(this).serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'موفق',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "{{ route('cities.index') }}";
                    });
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '<br>';
                });
                
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    html: errorMessage
                });
            }
        });
    });
});
</script>
@endpush