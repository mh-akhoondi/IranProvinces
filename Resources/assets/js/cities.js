// Resources/assets/js/cities.js
'use strict';

class CityManager {
    constructor() {
        // تعریف متغیرهای مورد نیاز
        this.table = $('#cities-table');
        
        // راه‌اندازی اولیه
        this.init();
    }

    // راه‌اندازی
    init() {
        this.handleDelete();
    }

    // مدیریت حذف شهر
    handleDelete() {
        this.table.on('click', '.delete-table-row', (e) => {
            const cityId = $(e.currentTarget).data('city-id');
            
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
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteCity(cityId);
                }
            });
        });
    }

    // حذف شهر از طریق Ajax
    deleteCity(cityId) {
        $.ajax({
            url: `/admin/cities/${cityId}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success) {
                    // بروزرسانی جدول
                    this.table.DataTable().ajax.reload();
                    
                    // نمایش پیام موفقیت
                    Swal.fire({
                        icon: 'success',
                        title: 'موفق',
                        text: response.message,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            },
            error: (xhr) => {
                // نمایش پیام خطا
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
}

// راه‌اندازی کلاس هنگام لود صفحه
$(document).ready(() => {
    new CityManager();
});