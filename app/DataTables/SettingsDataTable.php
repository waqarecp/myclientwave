<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SettingsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['platform_name', 'created_at', 'api_key', 'api_url', 'username', 'password', 'status'])
            ->editColumn('platform_name', function (Setting $setting) {
                return view('pages/setting.columns._setting', compact('setting'));
            })
            // ->editColumn('api_key', function (Setting $setting) {
            //     return sprintf(
            //         '<div data-bs-target="license" class="float-right">%s<button data-action="copy" class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light"><i class="ki-solid ki-copy fs-2"></i></button></div>', 
            //         strlen($setting->api_key) > 30 ? substr($setting->api_key, 0, 30) . " ..." : $setting->api_key);
            // })
            ->editColumn('api_key', function (Setting $setting) {
                return $setting->api_key ? (strlen($setting->api_key) > 30 ? substr($setting->api_key, 0, 30) . " ..." : $setting->api_key) : '---';
            })
            ->editColumn('status', function (Setting $setting) {
                return sprintf(
                    '<span class="badge badge-light-' . ($setting->status == 1 ? 'success' : 'danger' ) . ' fs-7 fw-semibold">' . ($setting->status == 1 ? 'Active' : 'Inactive' ) . '</span> <i class="fa fa-info-circle" title="Created at ' . (\Carbon\Carbon::parse($setting->created_at)->format('d F Y, g:i a')) . ', Last updated ' . (\Carbon\Carbon::parse($setting->updated_at)->format('d F Y, g:i a')) . '"></i>'
                );
            })
            ->addColumn('dealerName', function (Setting $setting) {
                return $setting->dealerName ? (strlen($setting->dealerName) > 30 ? substr($setting->dealerName, 0, 30) . " ..." : $setting->dealerName) : '---';
            })
            ->addColumn('action', function (Setting $setting) {
                return view('pages/setting.columns._actions', compact('setting'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Setting $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('api_credentials.*', 'dealers.dealerName')
            ->leftJoin('dealers', 'api_credentials.dealer_id', '=', 'dealers.id')
            ->whereNull('api_credentials.deleted_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('setting-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/setting/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('platform_name')->addClass('align-items-center')->name('platform_name')->title('Platform')->searchable(true),
            Column::make('dealerName')->title('Dealer Name')->searchable(true),
            Column::make('api_key')->title('API Key')->addClass('text-nowrap'),
            Column::make('username')->title('Username')->addClass('text-nowrap'),
            Column::make('password')->title('Password')->addClass('text-nowrap'),
            Column::make('status')->title('Status'),
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
        return 'Settings_' . date('YmdHis');
    }
}
