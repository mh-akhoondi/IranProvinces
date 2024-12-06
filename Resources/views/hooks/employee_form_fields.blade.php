// Resources/views/hooks/employee_form_fields.blade.php

@if(config('iranprovinces.forms.employee.show_birth_place') || config('iranprovinces.forms.employee.show_residence'))
<div class="col-12">
    <x-cards.data :title="__('iranprovinces::app.location_information')" class="mt-4">
        <div class="row">
            {{-- بخش محل تولد --}}
            @if(config('iranprovinces.forms.employee.show_birth_place'))
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <x-forms.select 
                            fieldId="birth_province_id"
                            :fieldLabel="__('iranprovinces::app.birth_province')"
                            fieldName="birth_province_id"
                            :fieldRequired="config('iranprovinces.forms.employee.required_fields.birth_place')"
                            search="true">
                            <option value="">@lang('app.select') @lang('iranprovinces::app.province')</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}"
                                    @selected(isset($employee) && $employee->birth_province_id == $province->id)>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-6">
                        <x-forms.select 
                            fieldId="birth_city_id"
                            :fieldLabel="__('iranprovinces::app.birth_city')"
                            fieldName="birth_city_id"
                            :fieldRequired="config('iranprovinces.forms.employee.required_fields.birth_place')"
                            search="true">
                            <option value="">@lang('iranprovinces::app.select_province_first')</option>
                            @if(isset($employee) && $employee->birth_city)
                                <option value="{{ $employee->birth_city_id }}" selected>
                                    {{ $employee->birth_city->name }}
                                </option>
                            @endif
                        </x-forms.select>
                    </div>
                </div>
            </div>
            @endif

            {{-- بخش محل سکونت --}}
            @if(config('iranprovinces.forms.employee.show_residence'))
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-forms.select 
                            fieldId="residence_province_id"
                            :fieldLabel="__('iranprovinces::app.residence_province')"
                            fieldName="residence_province_id"
                            :fieldRequired="config('iranprovinces.forms.employee.required_fields.residence')"
                            search="true">
                            <option value="">@lang('app.select') @lang('iranprovinces::app.province')</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}"
                                    @selected(isset($employee) && $employee->residence_province_id == $province->id)>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </x-forms.select>
                    </div>
                    <div class="col-md-6">
                        <x-forms.select 
                            fieldId="residence_city_id"
                            :fieldLabel="__('iranprovinces::app.residence_city')"
                            fieldName="residence_city_id"
                            :fieldRequired="config('iranprovinces.forms.employee.required_fields.residence')"
                            search="true">
                            <option value="">@lang('iranprovinces::app.select_province_first')</option>
                            @if(isset($employee) && $employee->residence_city)
                                <option value="{{ $employee->residence_city_id }}" selected>
                                    {{ $employee->residence_city->name }}
                                </option>
                            @endif
                        </x-forms.select>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </x-cards.data>
</div>
@endif