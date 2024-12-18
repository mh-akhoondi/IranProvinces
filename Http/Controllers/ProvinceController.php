<?php

namespace Modules\IranProvinces\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\IranProvinces\Models\Province;
use Modules\IranProvinces\Http\Requests\ProvinceRequest;
use Modules\IranProvinces\Http\DataTables\ProvinceDataTable;

class ProvinceController extends Controller
{
    public function index(ProvinceDataTable $dataTable)
    {
        return $dataTable->render('iranprovinces::provinces.index');
    }

    public function create()
    {
        return view('iranprovinces::provinces.create');
    }

    public function store(ProvinceRequest $request)
    {
        $province = Province::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'استان با موفقیت ایجاد شد',
            'data' => $province
        ]);
    }

    public function edit(Province $province)
    {
        return view('iranprovinces::provinces.edit', compact('province'));
    }

    public function update(ProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'استان با موفقیت بروزرسانی شد',
            'data' => $province
        ]);
    }

    public function destroy(Province $province)
    {
        $province->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'استان با موفقیت حذف شد'
        ]);
    }
}