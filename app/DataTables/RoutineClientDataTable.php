<?php

namespace App\DataTables;

use App\Models\RoutineClientModel;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class RoutineClientDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'routine_clients.datatables_actions')
            ->addColumn('teacher_name', function (RoutineClientModel $model) {
                if (!empty($model->user)) {
                    return $model->user->name;
                } else {
                    return '';
                }
            })
            ->addColumn('routine_name', function (RoutineClientModel $model) {
                if (!empty($model->routine)) {
                    return $model->routine->name;
                } else {
                    return '';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RoutineClientModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RoutineClientModel $model)
    {
        return $model
            ->with('client')
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
                'language' => ['url' => url('/lang/Spanish.json')],
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    //['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Rutina', 'data' => 'routine_name'],
            ['title' => 'Instructor', 'data' => 'teacher_name'],
            ['title' => 'Nombre Cliente', 'data' => 'client.name'],
            ['title' => '# Socio cliente', 'data' => 'client.membership_number'],
            ['title' => 'Fecha de inicio', 'data' => 'start_at'],
            ['title' => 'Fecha de fin', 'data' => 'end_at'],
            ['title' => 'Status', 'data' => 'status'],
            ['title' => 'Dias solicitados', 'data' => 'requested_days'],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'routine_clientsdatatable_' . time();
    }
}
