<?php

namespace App\DataTables;

use App\Models\LeadSource;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;

class LeadsourceDataTable extends DataTable
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
            ->rawColumns(['source_name', 'created_at'])
            ->editColumn('source_name', function (LeadSource $leadsource) {
                return view('pages/leadsource.columns._leadsource', compact('leadsource'));
            })
            ->editColumn('created_at', function (LeadSource $leadsource) {
                return \Carbon\Carbon::parse($leadsource->created_at)->format('d F Y, g:i a');
            })
            ->addColumn('action', function (LeadSource $leadsource) {
                return view('pages/leadsource.columns._actions', compact('leadsource'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(LeadSource $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('deleted_at')->where('company_id', Auth::user()->company_id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('leadsource-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/leadsource/columns/_draw-scripts.js')) . "}");
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
            Column::make('source_name')->addClass('align-items-center')->name('source_name')->title('Name')->searchable(true),
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
        return 'LeadSources_' . date('YmdHis');
    }
}
