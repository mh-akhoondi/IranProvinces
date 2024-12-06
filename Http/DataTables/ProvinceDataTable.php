<?php

namespace Modules\IranProvinces\Http\DataTables;

use Modules\IranProvinces\Models\Province;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProvinceDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $action = '<div class="task_view">';
                $action .= '<div class="dropdown">';
                $action .= '<a class="task_view_more d-flex align-items-center justify-content-center dropdown-toggle" type="link" id="dropdownMenuLink-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $action .= '<i class="icon-options-vertical icons"></i>';
                $action .= '</a>';
                $action .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '">';
                
                $action .= '<a href="' . route('admin.provinces.edit', $row->id) . '" class="dropdown-item">
                    <i class="fa fa-edit mr-2"></i>ویرایش
                </a>';
                
                $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-province-id="' . $row->id . '">
                    <i class="fa fa-trash mr-2"></i>حذف
                </a>';
                
                $action .= '</div>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('is_active', function ($row) {
                return $row->is_active 
                    ? '<span class="badge badge-success">فعال</span>' 
                    : '<span class="badge badge-danger">غیرفعال</span>';
            })
            ->editColumn('created_at', function ($row) {
                return jdate($row->created_at)->format('Y/m/d');
            })
            ->rawColumns(['action', 'is_active']);
    }

    public function query(Province $model)
    {
        return $model->newQuery()->select(['id', 'name', 'is_active', 'created_at']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('provinces-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->language([
                'url' => url('/vendor/datatables/Persian.json')
            ])
            ->buttons(
                Button::make('create')
                    ->text('<i class="fa fa-plus"></i> افزودن استان')
                    ->addClass('btn btn-primary'),
                Button::make('reload')
                    ->text('<i class="fa fa-refresh"></i> بارگذاری مجدد')
                    ->addClass('btn btn-default')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('شناسه')
                ->width(60),
            Column::make('name')
                ->title('نام استان'),
            Column::make('is_active')
                ->title('وضعیت'),
            Column::make('created_at')
                ->title('تاریخ ایجاد'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('عملیات')
        ];
    }
}