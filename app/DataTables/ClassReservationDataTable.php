<?php

namespace App\DataTables;

use App\Models\ClassReservation;
use App\Models\ClassReservationModel;
use App\Util\ClassesService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ClassReservationDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 *
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable( $query ) {
		$dataTable = new EloquentDataTable( $query );

		return $dataTable->addColumn( 'action', 'class_reservations.datatables_actions' )
		                 ->addColumn( 'client_dni', 'class_reservations.datatables_actions_client' )
		                 ->addColumn( 'class_schedule', 'class_reservations.datatables_actions_class' )
		                 ->rawColumns( [ 'client_dni', 'action', 'class_schedule' ] )
		                 ->editColumn( 'day', function ( $item ) {
			                 return ClassesService::days()[ $item->day ];
		                 } )->editColumn( 'status', function ( $item ) {
		                 	if($item->status == 'pending'){
		                 		return 'Inscrita';
		                    }else if($item->status == 'canceled'){
			                    return 'Cancelada';
		                    }else if($item->status == 'finished'){
			                    return 'Finalizada';
		                    }else if($item->status == 'unfulfilled'){
			                    return 'Inasistencia';
		                    }
			} );

	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\ClassReservation $model
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query( ClassReservationModel $model ) {
		return $model->with( 'client' )
            ->with( 'class_schedule' )->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
		            ->columns( $this->getColumns() )
		            ->minifiedAjax()
		            ->addAction( [ 'width' => '120px', 'printable' => false, 'title' => 'Acción' ] )
		            ->parameters( [
			            'language'  => [ 'url' => url( '/lang/Spanish.json' ) ],
			            'dom'       => 'Bfrtip',
			            'stateSave' => true,
			            'order'     => [ [ 0, 'desc' ] ],
			            'buttons'   => [
				            [ 'extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner', ],
				            [ 'extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner', ],
				            [ 'extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner', ],
				            [ 'extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner', ],
			            ],
		            ] );
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			['title' => 'id', 'data' => 'id'],
			[ 'title' => 'Dni cliente', 'data' => 'client_dni' ],
			[ 'title' => 'Nombre cliente', 'data' => 'client.name' ],
			[ 'title' => 'Clase', 'data' => 'class_schedule' ],
			[ 'title' => 'Dia', 'data' => 'day' ],
			[ 'title' => 'Fecha', 'data' => 'date' ],
			[ 'title' => 'Hora', 'data' => 'start_time' ],
			'status'
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'class_reservationsdatatable_' . time();
	}
}
