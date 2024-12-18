<?php
namespace Modules\IranProvinces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:provinces,name,' . $this->province?->id,
            'is_active' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام استان الزامی است',
            'name.unique' => 'این نام استان قبلاً ثبت شده است',
            'name.max' => 'نام استان نمی‌تواند بیشتر از 255 کاراکتر باشد'
        ];
    }
}