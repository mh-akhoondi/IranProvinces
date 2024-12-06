// Resources/assets/js/province-form.js
'use strict';

class ProvinceForm {
    constructor() {
        // تعریف متغیرهای مورد نیاز
        this.form = $('#province-form');
        this.submitBtn = this.form.find('button[type="submit"]');
        
        // راه‌اندازی اولیه
        this.init();
    }

    // راه‌اندازی
    init() {
        this.setupValidation();
        this.handleSubmit();
    }

    // تنظیم اعتبارسنجی فرم
    setupValidation() {
        this.form.validate({
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
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        });
    }

    // مدیریت ارسال فرم
    handleSubmit() {
        this.form.on('submit', (e) => {
            if (!this.form.valid()) {
                e.preventDefault();
                return;
            }

            this.submitBtn.prop('disabled', true);
            this.submitBtn.html('<i class="fa fa-spinner fa-spin ml-1"></i> در حال ذخیره...');
        });
    }
}

// راه‌اندازی کلاس هنگام لود صفحه
$(document).ready(() => {
    new ProvinceForm();
});