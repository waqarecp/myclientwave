<?php

namespace App\DataTables;

use App\Models\StateColour;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;


class StateColourDataTable extends DataTable
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
            ->rawColumns(['state_name', 'created_by', 'created_at'])
            ->editColumn('state_name', function (StateColour $statecolour) {
                return view('pages/statecolour.columns._statecolour', compact('statecolour'));
            })
            ->editColumn('created_by', function (StateColour $statecolour) {
                return $statecolour->user->name;
            })
            ->editColumn('created_at', function (StateColour $statecolour) {
                return \Carbon\Carbon::parse($statecolour->created_at)->format('d F Y, g:i a');
            })
            ->addColumn('action', function (StateColour $statecolour) {
                return view('pages/statecolour.columns._actions', compact('statecolour'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(StateColour $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('deleted_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('state-colour-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/statecolour/columns/_draw-scripts.js')) . "}");
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
            Column::make('state_name')->addClass('align-items-center')->name('state_name')->title('State Name')->searchable(true),
            Column::make('created_by')->title('Created By')->addClass('text-nowrap'),
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
        return 'StateColours_' . date('YmdHis');
    }
}
