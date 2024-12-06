<?php
namespace Modules\IranProvinces\Http\Controllers;

use Illuminate\Routing\Controller; // این خط تغییر کرد
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
        Province::create($request->validated());
        return redirect()->route('provinces.index')->with('success', 'استان با موفقیت ایجاد شد');
    }

    public function edit(Province $province)
    {
        return view('iranprovinces::provinces.edit', compact('province'));
    }

    public function update(ProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());
        return redirect()->route('provinces.index')->with('success', 'استان با موفقیت بروزرسانی شد');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return response()->json(['message' => 'استان با موفقیت حذف شد']);
    }
}