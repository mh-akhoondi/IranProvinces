// Http/Controllers/CityController.php
<?php

namespace Modules\IranProvinces\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\IranProvinces\Models\City;
use Modules\IranProvinces\Models\Province;
use Modules\IranProvinces\Http\Requests\CityRequest;
use Modules\IranProvinces\Http\DataTables\CityDataTable;

class CityController extends Controller
{
    /**
     * نمایش لیست شهرها
     */
    public function index(CityDataTable $dataTable)
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('view_cities'), 403);

        return $dataTable->render('iranprovinces::cities.index');
    }

    /**
     * نمایش فرم ایجاد شهر جدید
     */
    public function create()
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('create_cities'), 403);

        // دریافت لیست استان‌های فعال
        $provinces = Province::active()->orderBy('name')->get();

        return view('iranprovinces::cities.create', compact('provinces'));
    }

    /**
     * ذخیره شهر جدید
     */
    public function store(CityRequest $request)
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('create_cities'), 403);

        try {
            City::create($request->validated());

            return redirect()
                ->route('admin.cities.index')
                ->with('success', trans('iranprovinces::messages.success.store'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', trans('iranprovinces::messages.error.store'));
        }
    }

    /**
     * نمایش فرم ویرایش شهر
     */
    public function edit(City $city)
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('edit_cities'), 403);

        // دریافت لیست استان‌های فعال
        $provinces = Province::active()->orderBy('name')->get();

        return view('iranprovinces::cities.edit', compact('city', 'provinces'));
    }

    /**
     * بروزرسانی اطلاعات شهر
     */
    public function update(CityRequest $request, City $city)
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('edit_cities'), 403);

        try {
            $city->update($request->validated());

            return redirect()
                ->route('admin.cities.index')
                ->with('success', trans('iranprovinces::messages.success.update'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', trans('iranprovinces::messages.error.update'));
        }
    }

    /**
     * حذف شهر
     */
    public function destroy(City $city)
    {
        // بررسی دسترسی کاربر
        abort_unless(auth()->user()->can('delete_cities'), 403);

        try {
            $city->delete();

            return response()->json([
                'success' => true,
                'message' => trans('iranprovinces::messages.success.delete')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('iranprovinces::messages.error.delete')
            ], 500);
        }
    }

    /**
     * دریافت لیست شهرهای یک استان
     */
    public function getCitiesByProvince(Province $province)
    {
        $cities = $province->cities()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }
}