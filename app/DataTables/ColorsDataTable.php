<?php

namespace App\DataTables;

use App\Models\Color;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ColorsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.colors.btn.checkbox')
            ->addColumn('color', 'admin.colors.btn.color')
            ->addColumn('actions', 'admin.colors.btn.btn')
            ->rawColumns([
                'actions',
                'color',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Color $model)
    {
        return $model->newQuery();
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
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_color'), 'className' => 'btn btn-info', "action" => "function(){

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
                // 'buttons'      => [
                //     'export', 'print', 'reset', 'reload'
                // ]
            ]);
        // ->buttons(
        //     Button::make('create', trans('admin.create')),
        //     Button::make(trans('admin.export')),
        //     Button::make('pdf'),
        //     Button::make('csv'),
        //     Button::make('excel'),
        //     Button::make('reset', trans('admin.reset')),
        //     Button::make('reload', trans('admin.reload'))
        // )
        // ->lengthMenu([10, 25, 50, 100], [10, 25, 50, 'All Record'])->parameters([]);
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
                'name'  => 'name_ar',
                'data'  => 'name_ar',
                'title' => __('admin.name_ar'),
            ], [
                'name'  => 'name_en',
                'data'  => 'name_en',
                'title' => __('admin.name_en'),
            ],
            [
                'name'       => 'color',
                'data'       => 'color',
                'title'      => trans('admin.color'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => __('admin.created_at'),
            ],
            [
                'name'  => 'updated_at',
                'data'  => 'updated_at',
                'title' => __('admin.updated_at'),
            ], [
                'name'       => 'actions',
                'data'       => 'actions',
                'title'      => trans('admin.actions'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ]

            // Column::make('id'),
            // Column::make('name'),
            // Column::make('email'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            // Column::computed('actions')
            //     ->exportable(false)
            //     ->printable(false)
            //     // ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Colors_' . date('YmdHis');
    }
}
