<?php

namespace App\DataTables;

use App\Models\Purchase;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PurchaseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * ->addColumn('status', 'admin.purchases.btn.status')
            ->addColumn('payment_status', 'admin.purchases.btn.payment_status')
            'status',
                'payment_status'
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.purchases.btn.checkbox')
            ->addColumn('actions', 'admin.purchases.btn.btn')
            ->addColumn('status', 'admin.purchases.btn.status')
            ->addColumn('payment_status', 'admin.purchases.btn.payment_status')
            ->rawColumns([
                'actions',
                'checkbox',
                'status',
                'payment_status'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function query(Purchase $model)
    {

        return $model->with(['admins', 'users', 'products'])->latest();
        // return $model->with(['admins', 'users', 'products'])->latest();
        // return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 'All Record']],
                'buttons'    => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_purchase'), 'className' => 'btn btn-info', "action" => "function(){

							window.location.href = '" . \URL::current() . "/create';
						}"
                    ],

                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> ' . trans('admin.ex_csv')],
                    ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> ' . trans('admin.ex_excel')],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fas fa-undo"></i>'],
                    [
                        'text' => '<i class="fa fa-trash"></i>', 'className' => 'btn btn-danger delBtn'
                    ],

                ],
                'initComplete' => " function () {
		            this.api().columns([1,2]).every(function () {
		                var column = this;
		                var input = document.createElement(\"input\");
		                $(input).appendTo($(column.footer()).empty())
		                .on('keyup', function () {
		                    column.search($(this).val(), false, false, true).draw();
		                });
		            });
                }",
                'language'         => datatable_lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'       => 'checkbox',
                'data'       => 'checkbox',
                'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'  => 'id',
                'data'  => 'id',
                'title' => '#',
            ], [
                'name'  => 'admins.name',
                'data'  => 'admins.name',
                'title' => __('admin.added_by'),
            ], [
                'name'  => 'users.name',
                'data'  => 'users.name',
                'title' => __('admin.user_name'),
            ],
            [
                'name'  => 'products.title',
                'data'  => 'products.title',
                'title' => __('admin.product_title'),
            ],
            [
                'name'  => 'status',
                'data'  => 'status',
                'title' => __('admin.status'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'name'  => 'total_price',
                'data'  => 'total_price',
                'title' => __('admin.total_price'),
            ],
            [
                'name'  => 'payment_status',
                'data'  => 'payment_status',
                'title' => __('admin.payment_status'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'       => 'actions',
                'data'       => 'actions',
                'title'      => trans('admin.actions'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Purchase' . date('YmdHis');
    }
}
