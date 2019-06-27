<?php

namespace App\DataTables;

use App\Models\ClassScheduleModel;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClassScheduleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', 'class_schedules.datatables_actions')
            ->editColumn('status', function($classSchedule) {
                $status = ($classSchedule->status ==1)
                    ? 'Activo'
                    : 'Inactivo';
                return $status;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClassScheduleModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClassScheduleModel $model)
    {
        return $model
        ->with('class')
        ->with('user')
        ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'language' => [ 'url' => url( '/lang/Spanish.json' ) ],
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            ['title' => '#', 'data' => 'id'],
            ['title' => 'Clase', 'data' => 'class.name'],
            ['title' => 'Nombre', 'data' => 'user.name'],
            ['title' => 'Cantidad Min', 'data' => 'quota_min'],
            ['title' => 'Cantidad Max', 'data' => 'quota_max'],
            ['title' => 'Inicio', 'data' => 'start_at'],
            ['title' => 'Fin', 'data' => 'end_at'],
            ['title' => 'Estado', 'data' => 'status'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'class_schedulesdatatable_' . time();
    }
}
