<?php

namespace App\DataTables;

use App\Models\ClassReservation;
use App\Models\ClassReservationModel;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClassReservationDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'class_reservations.datatables_actions')
            ->addColumn( 'client_dni', 'class_reservations.datatables_actions_client' )
            ->rawColumns( [ 'client_dni', 'action' ] );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClassReservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClassReservationModel $model)
    {
        return $model->with('client')->newQuery();
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
            ['title' => 'Dni cliente', 'data' => 'client_dni'],
            ['title' => 'Nombre cliente', 'data' => 'client.name'],
            'class_schedule_id',
            'day',
            'start_time',
            'date',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'class_reservationsdatatable_' . time();
    }
}
