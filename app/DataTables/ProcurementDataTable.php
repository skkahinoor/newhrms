<?php

namespace App\DataTables;

use App\Models\Procurement;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProcurementDataTable extends DataTable
{
    // DataTable query method with filters applied
    public function query(Procurement $model): QueryBuilder
    {
        $query = $model->newQuery()->with('users');

        // Apply filters based on the request parameters
        if ($this->request()->get('procurement_number')) {
            $query->where('procurement_number', 'like', '%' . $this->request()->get('procurement_number') . '%');
        }
        if ($this->request()->get('user_id')) {
            $query->where('user_id', $this->request()->get('user_id'));
        }
        if ($this->request()->get('asset_type_id')) {
            $query->where('asset_type_id', $this->request()->get('asset_type_id'));
        }
        if ($this->request()->get('request_date')) {
            $query->whereDate('request_date', $this->request()->get('request_date'));
        }
        if ($this->request()->get('delivery_date')) {
            $query->whereDate('delivery_date', $this->request()->get('delivery_date'));
        }

        return $query;
    }

    // DataTable columns and customization
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function ($procurement) {
                return $procurement->users->name;
            })
            ->editColumn('request_date', function ($procurement) {
                return $procurement->request_date ? date('d-m-Y',strtotime($procurement->request_date))  : 'Not Set';
            })
            ->editColumn('delivery_date', function ($procurement) {
                return $procurement->delivery_date ?  date('d-m-Y',strtotime($procurement->delivery_date)) : 'Not Set';
            })->addColumn('action', function ($procurement) {
            $role = Role::where('slug', 'admin')->value('id');
            $isAdmin = auth()->user()->role_id == $role ? true : false;
            $id = $procurement->id;
            $status = $procurement->status;
            return view('admin.procurement.common.action',compact('isAdmin','id','status'));
        });
    }

    // Define the DataTable columns
    public function html()
    {
        return $this->builder()
            ->columns([
                Column::make('procurement_number'),
                Column::make('users.name')->title('Name'),
                Column::make('request_date'),
                Column::make('delivery_date'),
                Column::computed('action')->exportable(false)->printable(false)->width(100)->addClass('text-center'),
            ])
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['excel', 'csv', 'pdf'],
            ]);
    }

    // Additional methods
    public function getColumns(): array
    {
        return [
            //     Column::computed('action')
            //         ->exportable(false)
            //         ->printable(false)
            //         ->width(60)
            //         ->addClass('text-center'),
            Column::make('id'),
            Column::make('procurement_number'),
            Column::make('user_id'),
            Column::make('email'),
            Column::make('request_date'),
            Column::make('delivery_date'),
            Column::computed('action'),
        ];
    }

    // File name for export
    protected function filename(): string
    {
        return 'Procurement_' . date('YmdHis');
    }
}
