<?php

namespace Modules\IranProvinces\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\IranProvinces\Models\Province;
use Modules\IranProvinces\Http\Requests\ProvinceRequest;
use Modules\IranProvinces\Http\DataTables\ProvinceDataTable;

class ProvinceController extends Controller
{
    public function index(ProvinceDataTable \)
    {
        return \->render('iranprovinces::provinces.index');
    }

    public function create()
    {
        return view('iranprovinces::provinces.create');
    }

    public function store(ProvinceRequest \)
    {
        Province::create(\->validated());
        return redirect()->route('provinces.index')->with('success', 'استان با موفقیت ایجاد شد');
    }

    public function edit(Province \)
    {
        return view('iranprovinces::provinces.edit', compact('province'));
    }

    public function update(ProvinceRequest \, Province \)
    {
        \->update(\->validated());
        return redirect()->route('provinces.index')->with('success', 'استان با موفقیت بروزرسانی شد');
    }

    public function destroy(Province \)
    {
        \->delete();
        return response()->json(['message' => 'استان با موفقیت حذف شد']);
    }
}
