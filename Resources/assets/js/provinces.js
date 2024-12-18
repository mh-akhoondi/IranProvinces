// Resources/assets/js/provinces.js
'use strict';

$(function() {
    // تنظیمات DataTable
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: '/vendor/datatables/Persian.json'
        }
    });

    // حذف استان
    $(document).on('click', '.delete-table-row', function() {
        var provinceId = $(this).data('province-id');
        
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: 'این عملیات قابل بازگشت نیست!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله، حذف شود',
            cancelButtonText: 'انصراف',
            customClass: {
                confirmButton: 'btn btn-danger ml-1',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: `/admin/provinces/${provinceId}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#provinces-table').DataTable().ajax.reload();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'موفق',
                            text: 'استان با موفقیت حذف شد',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: 'عملیات با خطا مواجه شد',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            }
        });
    });
});