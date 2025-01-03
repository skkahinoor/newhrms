<?php

namespace App\DataTables;

use App\Models\Procurement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProcurementDataTable extends DataTable
{
    // DataTable query method with filters applied
    public function query(Procurement $model): QueryBuilder
    {

        $roleAdminId = Role::where('slug', 'admin')->value('id');
        $currentUser = Auth::user();

        // Admins see all procurements
        if ($currentUser->role_id == $roleAdminId) {
            $query = $model->newQuery()->with('users');
        }
        // Supervisors see procurements
        elseif ($currentUser->supervisor_id) {
            $query = $model->newQuery()
                ->with('users')
                ->where(function ($q) use ($currentUser) {
                    $q->where('supervisor_id', $currentUser->id)
                        ->orWhere('user_id', $currentUser->id);
                });
        }
        // General users
        else {
            $query = $model->newQuery()
                ->with('users')
                ->where('user_id', $currentUser->id);
        }

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

        $currentUser = Auth::user();
        $roleAdminId = Role::where('slug', 'admin')->value('id');
        $isAdmin = $currentUser->role_id == $roleAdminId;
        $isSupervisor = User::where('supervisor_id', $currentUser->id)->exists(); 
    

        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('user_id', function ($procurement) {
                return $procurement->users->name ?? 'N/A';
            })
            ->editColumn('request_date', function ($procurement) {
                return $procurement->request_date ? date('d-m-Y', strtotime($procurement->request_date)) : 'Not Set';
            })
            ->editColumn('delivery_date', function ($procurement) {
                return $procurement->delivery_date ? date('d-m-Y', strtotime($procurement->delivery_date)) : 'Not Set';
            })
            ->editColumn('procurement_number', function ($procurement) {
                return '<span class="copy-procurement-number pro-copy-hover" data-number="' . $procurement->procurement_number . '" style="cursor: pointer;">' . $procurement->procurement_number . '</span>';
            })
            ->editColumn('status', function ($procurement) {
                $statusColors = [
                    0 => ['color' => '#000000', 'background' => '#f0ad4e', 'text' => 'Pending'],
                    1 => ['color' => '#ffffff', 'background' => '#0275d8', 'text' => 'Approved'],
                    2 => ['color' => '#ffffff', 'background' => '#5bc0de', 'text' => 'In Process'],
                    3 => ['color' => '#ffffff', 'background' => '#5cb85c', 'text' => 'Delivered'],
                    4 => ['color' => '#ffffff', 'background' => '#d9534f', 'text' => 'Pause'],
                    null => ['color' => '#ffffff', 'background' => '#d9534f', 'text' => 'Not Set'],
                ];
                $status = $statusColors[$procurement->status];
                return '<span style="color: ' . $status['color'] . '; background-color: ' . $status['background'] . '; padding: 5px 10px; border-radius: 5px;">' . $status['text'] . '</span>';
            })
            ->rawColumns(['procurement_number', 'status'])
            ->addColumn('action', function ($procurement) use ($isAdmin, $isSupervisor, $currentUser) {
                $status = $procurement->status;
                $id = $procurement->id;
                return view('admin.procurement.common.action', compact('isAdmin', 'isSupervisor', 'currentUser', 'procurement', 'status', 'id'));
            });
    }

    // Define the DataTable columns
    public function html()
    {
        return $this->builder()
            ->setTableId('procurement-datatable')
            ->columns([
                Column::computed('DT_RowIndex')->title('#')->searchable(false)->orderable(false)->addClass('text-center'),
                Column::make('procurement_number')->addClass('text-center'),
                Column::make('users.name')->title('Name')->addClass('text-center'),
                Column::make('request_date')->addClass('text-center'),
                Column::make('delivery_date')->addClass('text-center'),
                Column::make('status')->addClass('text-center'),
                Column::computed('action')->exportable(true)->printable(false)->width(100)->addClass('text-center'),
            ])
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->buttons(
                'copy', 'csv', 'excel', 'pdf', 'print'
            )
            ->parameters([
                'lengthMenu' => [10, 25, 50, 100],
                'pageLength' => 10,
                'language' => [
                    'lengthMenu' => 'Show _MENU_ entries',
                    'info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
                ],
            ]);
    }

    // Additional methods
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('procurement_number'),
            Column::make('user_id'),
            Column::make('email'),
            Column::make('request_date'),
            Column::make('delivery_date'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    // File name for export
    protected function filename(): string
    {
        return 'Procurement_' . date('YmdHis');
    }
}
