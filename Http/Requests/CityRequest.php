<?php

namespace Modules\IranProvinces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'province_id.required' => 'انتخاب استان الزامی است',
            'province_id.exists' => 'استان انتخاب شده معتبر نیست',
            'name.required' => 'نام شهر الزامی است',
            'name.max' => 'نام شهر نمی‌تواند بیشتر از 255 کاراکتر باشد'
        ];
    }
}
