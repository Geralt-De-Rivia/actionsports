<?php

namespace App\DataTables;

use App\Models\RoutineActivityModel;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RoutinesActiviyDataTable extends DataTable
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

    
        return $dataTable->addColumn('action', 'routines_activity.datatables_actions')
            ->editColumn('day', function($class) {
                switch($class->day){
                    case 0:
                        $day = 'DOMINGO';
                    break;
                    case 1:
                        $day = 'LUNES';
                    break;
                    case 2:
                        $day = 'MARTES';
                    break;
                    case 3:
                        $day = 'MIERCOLES';
                    break;
                    case 4:
                        $day = 'JUEVES';
                    break;
                    case 5:
                        $day = 'VIERNES';
                    break;
                    case 6:
                        $day = 'SABADO';
                    break;
                }
                return $day;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RoutineModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RoutineActivityModel $model)
    {
        return $model
            ->with('Activity')
            ->with('Routine')
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
	        ['title' => 'id', 'data' => 'id'],
	        ['title' => 'Días', 'data' => 'day'],
            ['title' => 'Actividad', 'data' => 'activity.name'],
            ['title' => 'Rutina', 'data' => 'routine.name'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'routines_activitydatatable_' . time();
    }
}
