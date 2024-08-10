<?php

namespace App\DataTables;

use App\Models\Lead;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LeadDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['first_name', 'mobile', 'email', 'lead_source_id', 'created_by'])
            ->editColumn('first_name',  function (Lead $lead) {
                return view('pages/lead.columns._lead', compact('lead'));
            })
            ->editColumn('lead_source_id', function (Lead $lead) {
                return $lead->leadSource ? $lead->leadSource->source_name : 'N/A'; // Display 'source_name' or 'N/A' if not set
            })
            ->editColumn('lead_status', function (Lead $lead) {
                return $lead->status;
            })
            ->editColumn('created_by', function (Lead $lead) {
                $created_at = \Carbon\Carbon::parse($lead->created_at)->format('d F Y');
                $created_by = $lead->created_by ? $lead->user->name : 'N/A';
                return $created_by . ' | ' .$created_at;
            })
            ->addColumn('action', function (Lead $lead) {
                return view('pages/lead.columns._actions', compact('lead'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Lead $model): QueryBuilder
    {
        return $model->newQuery()->with('leadSource')->with('utilityCompany')->with('user')->with('company')->with('appointment')->with('note')->whereNull('deleted_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('lead-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/lead/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */

    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('align-items-center')->name('id')->title('Lead ID')->searchable(true),
            Column::make('first_name')->addClass('align-items-center')->name('first_name')->title('Name')->searchable(true),
            Column::make('mobile')->addClass('align-items-center')->name('mobile')->title('Mobile')->searchable(true),
            Column::make('email')->addClass('align-items-center')->name('email')->title('Email')->searchable(true),
            Column::make('lead_source_id')->addClass('align-items-center')->name('lead_source_id')->title('Lead Source')->searchable(true),
            Column::make('created_by')->addClass('align-items-center')->name('created_by')->title('Created By')->searchable(true),
            Column::make('lead_status')->addClass('align-items-center')->name('lead_status')->title('Status')->searchable(true),
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
        return 'Leads_' . date('YmdHis');
    }
}
