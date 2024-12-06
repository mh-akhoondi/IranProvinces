<?php

namespace Modules\IranProvinces\Http\DataTables;

use Modules\IranProvinces\Models\City;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
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
                $action .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-' . $row->id . '" tabindex="0">';

                $action .= '<a href="' . route('cities.edit', $row->id) . '" class="dropdown-item"><i class="fa fa-edit mr-2"></i>ویرایش</a>';

                $action .= '<a class="dropdown-item delete-table-row" href="javascript:;" data-user-id="' . $row->id . '">
                    <i class="fa fa-trash mr-2"></i>
                    حذف
                </a>';

                $action .= '</div>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('province_id', function ($row) {
                return $row->province->name;
            })
            ->editColumn('is_active', function ($row) {
                return $row->is_active ? 'فعال' : 'غیرفعال';
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'is_active']);
    }

    public function query(City $model)
    {
        return $model->newQuery()->with('province');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('cities-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )
            ->parameters([
                'language' => [
                    'url' => '/datatable/persian.json'
                ]
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#'),
            Column::make('name')->title('نام شهر'),
            Column::make('province_id')->title('استان'),
            Column::make('is_active')->title('وضعیت'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('عملیات'),
        ];
    }
}