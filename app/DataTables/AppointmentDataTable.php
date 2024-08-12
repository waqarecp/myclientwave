<?php

namespace App\DataTables;

use App\Models\Appointment;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;

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
            ->rawColumns(['appointment_date', 'appointment_time', 'appointment_notes'])
            ->editColumn('appointment_date', function (Appointment $appointment) {
                return view('pages/appointment.columns._appointment', compact('appointment'));
            })
            ->editColumn('appointment_notes', function (Appointment $appointment) {
                return strlen($appointment->appointment_notes) > 30 ? substr($appointment->appointment_notes, 0, 30) . " ..." : $appointment->appointment_notes;
            })
            ->editColumn('created_at', function (Appointment $appointment) {
                return \Carbon\Carbon::parse($appointment->created_at)->format('d F Y, g:i a');
            })
            ->addColumn('action', function (Appointment $appointment) {
                return view('pages/appointment.columns._actions', compact('appointment'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('deleted_at')->where('company_id', Auth::user()->company_id);
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
            Column::make('id')->addClass('align-items-center')->name('id')->title('ID')->searchable(true),
            Column::make('appointment_date')->addClass('align-items-center')->name('appointment_date')->title('Date')->searchable(true),
            Column::make('appointment_time')->addClass('align-items-center')->name('appointment_time')->title('Time')->searchable(true),
            Column::make('appointment_notes')->addClass('align-items-center')->name('appointment_notes')->title('Notes')->searchable(true),
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
