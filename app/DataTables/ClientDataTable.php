<?php

namespace App\DataTables;

use App\Models\ClientModel;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClientDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'clients.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClientModel $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClientModel $model)
    {
        return $model
            ->with('client_status')
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
	        'dni',
            ['title' => 'Nombre', 'data' => 'name'],
            ['title' => 'Apellido', 'data' => 'last_name'],
            ['title' => 'Número Telefono', 'data' => 'phone_number'],
            'email',
            ['title' => 'Código', 'data' => 'code'],
            //'image_url',
            //['title' => 'Número Membresia', 'data' => 'membership_number'],
            ['title' => 'Estado Cliente', 'data' => 'client_status.name', 'searchable' => false]
            //'birth_date',
            //'email_verified_at',
            //'password'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clientsdatatable_' . time();
    }
}
