<?php

namespace Modules\IranProvinces\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\IranProvinces\Models\City;
use Modules\IranProvinces\Models\Province;
use Modules\IranProvinces\Http\Requests\CityRequest;
use Modules\IranProvinces\Http\DataTables\CityDataTable;

class CityController extends Controller
{
    public function index(CityDataTable $dataTable)
    {
        return $dataTable->render('iranprovinces::cities.index');
    }

    public function create()
    {
        // دریافت لیست استان‌ها برای نمایش در فرم
        $provinces = Province::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
            
        return view('iranprovinces::cities.create', compact('provinces'));
    }

    public function store(CityRequest $request)
    {
        $city = City::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'شهر با موفقیت ایجاد شد',
            'data' => $city
        ]);
    }

    public function edit(City $city)
    {
        $provinces = Province::where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
            
        return view('iranprovinces::cities.edit', compact('city', 'provinces'));
    }

    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'شهر با موفقیت بروزرسانی شد',
            'data' => $city
        ]);
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'شهر با موفقیت حذف شد'
        ]);
    }
}