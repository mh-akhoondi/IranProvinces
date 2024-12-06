@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ویرایش استان {{ $province->name }}</h4>
            </div>
            <div class="card-body">
                <form id="update-province-data" action="{{ route('provinces.update', $province->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">نام استان</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $province->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">وضعیت</label>
                                <select class="form-control" id="is_active" name="is_active">
                                    <option value="1" {{ $province->is_active ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ !$province->is_active ? 'selected' : '' }}>غیرفعال</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">بروزرسانی</button>
                    <a href="{{ route('provinces.index') }}" class="btn btn-secondary">انصراف</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// اسکریپت برای هندل کردن فرم ویرایش با Ajax
$(document).ready(function() {
    $('#update-province-data').on('submit', function(e) {
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
                        window.location.href = "{{ route('provinces.index') }}";
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