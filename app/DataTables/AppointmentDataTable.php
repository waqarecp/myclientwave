<?php

namespace App\DataTables;

use App\Models\ViewGlobalData;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AppointmentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // Add the index column for serial number
            ->rawColumns(['full_name', 'appointment_date', 'appointment_time', 'status_name'])
            ->editColumn('appointment_date', function (ViewGlobalData $appointment) {
                return view('pages/appointment.columns._appointment', compact('appointment'));
            })
            ->editColumn('appointment_time', function (ViewGlobalData $appointment) {
                return \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A');
            })
            ->editColumn('full_name', function (ViewGlobalData $appointment) {
                return "<div class='d-flex flex-column'>
                       <a href='" . route('leads.show', $appointment->lead_id) . "' class='text-gray-800 text-hover-primary mb-1'>" 
                       . $appointment->full_name . '<br>LeadID # ' . str_pad($appointment->lead_id, 4, "0", STR_PAD_LEFT) . 
                       "</a>
                   </div>";
            })
            ->editColumn('created_at', function (ViewGlobalData $appointment) {
                return \Carbon\Carbon::parse($appointment->created_at)->format('d F Y, g:i a');
            })
            ->editColumn('status_name', function (ViewGlobalData $appointment) {
                return '<span class="badge badge-success badge-circle w-15px h-15px me-1" style="background-color:' . $appointment->color_code . ';"></span>' . $appointment->status_name;
            })
            ->addColumn('action', function (ViewGlobalData $appointment) {
                return view('pages/appointment.columns._actions', compact('appointment'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(ViewGlobalData $model): QueryBuilder
    {
        return $model->newQuery()
            ->whereNull('deleted_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('appointment-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/appointment/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex') // Use computed index for Sr. No.
            ->title('Sr. No.')
            ->searchable(false)
            ->orderable(false)
            ->addClass('align-items-center'),
            Column::make('full_name')->addClass('align-items-center')->title('Lead Info')->searchable(true),
            Column::make('appointment_date')->title('Appointment Date')->searchable(true),
            Column::make('appointment_time')->title('Appointment Time')->searchable(true),
            Column::make('status_name')->title('Appointment Status')->searchable(true),
            Column::make('created_at')->title('Created Date')->addClass('text-nowrap'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Appointments_' . date('YmdHis');
    }
}
