<?php

namespace App\DataTables;

use App\Models\UtilityCompany;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UtilityCompanyDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['source_name', 'created_at'])
            ->editColumn('source_name', function (UtilityCompany $utilitycompany) {
                return view('pages/utilitycompany.columns._utilitycompany', compact('utilitycompany'));
            })
            ->editColumn('created_at', function (UtilityCompany $utilitycompany) {
                return \Carbon\Carbon::parse($utilitycompany->created_at)->format('d F Y, g:i a');
            })
            ->addColumn('action', function (UtilityCompany $utilitycompany) {
                return view('pages/utilitycompany.columns._actions', compact('utilitycompany'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(UtilityCompany $model): QueryBuilder
    {
        return $model->newQuery()->whereNull('deleted_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('utilitycompany-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/utilitycompany/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('align-items-center')->name('id')->title('ID')->searchable(true),
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
        return 'UtilityCompanys_' . date('YmdHis');
    }
}
