<?php


namespace App\Util;


use App\Models\ActivityModel;
use App\Models\ClientActivityModel;
use App\Models\RoutineActivityModel;
use App\Models\RoutineClientModel;

class ClassActivityService {

	public function getRoundActivity( $clientId, $routineId ) {

		$routine = RoutineClientModel::with( 'user' )
		                             ->where( 'status', '=', 1 )
		                             ->where( 'client_id', '=', $clientId )
		                             ->where( 'routine_id', '=', $routineId )
		                             ->orderBy( 'start_at' )
		                             ->get()
		                             ->first();

		$response                = new \stdClass();
		$response->allActivities = null;
		$response->nextActivity  = null;
		if ( ! empty( $routine ) ) {


			$activities = RoutineActivityModel::all();

			$totalActivitiesCompleted = ClientActivityModel::where( 'routine_id', '=', $routine->id )
			                                               ->where( 'client_id', '=', $clientId )
			                                               ->get()
			                                               ->count();

			$rounds                   = intval( $totalActivitiesCompleted / $activities->count() );

			$activitiesCompleted = ClientActivityModel::where( 'routine_id', '=', $routine->id )
			                                          ->where( 'client_id', '=', $clientId )
			                                          ->orderBy( 'created_at', 'desc' )
			                                          ->skip( $activities->count() * $rounds )
			                                          ->take( $activities->count() )
			                                          ->get();

			$allActivities = [];
			foreach ( $activities as $item ) {
				$isCompleted     = $activitiesCompleted->search( function ( $value, $key ) use ( $item ) {
					return $value->activity_id == $item->id;
				} );
				$activity        = ActivityModel::find( $item->activity_id );
				$item->completed = is_numeric( $isCompleted );
				$item->activity  = EloquentPropertyUtil::build( $activity );
				if ( $response->nextActivity == null && ! $item->completed ) {
					$response->nextActivity      = $item->activity;
					$response->nextActivity->day = $item->day;
					$response->nextActivity->pending = $activities->count()-$activitiesCompleted->count();

				}
				array_push( $allActivities, $item );
			}
			$response->allActivities = Collect( $allActivities )->groupBy( 'day' );
		}

		return $response;
	}


	public function nextActivity( $clientId, $routineId ) {

		$routine = RoutineClientModel::with( 'user' )
		                             ->where( 'status', '=', 1 )
		                             ->where( 'client_id', '=', $clientId )
		                             ->where( 'routine_id', '=', $routineId )
		                             ->orderBy( 'start_at' )
		                             ->get()
		                             ->first();

		$nextActivity = null;
		if ( ! empty( $routine ) ) {

			$activities = RoutineActivityModel::all();

			$totalActivitiesCompleted = ClientActivityModel::where( 'routine_id', '=', $routine->id )
			                                               ->where( 'client_id', '=', $clientId )
			                                               ->get()
			                                               ->count();
			$rounds                   = intval( $totalActivitiesCompleted / $activities->count() );

			$activitiesCompleted = ClientActivityModel::where( 'routine_id', '=', $routine->id )
			                                          ->where( 'client_id', '=', $clientId )
			                                          ->orderBy( 'created_at', 'desc' )
			                                          ->skip( $activities->count() * $rounds )
			                                          ->take( $activities->count() )
			                                          ->get();

			foreach ( $activities as $item ) {
				$isCompleted     = $activitiesCompleted->search( function ( $value, $key ) use ( $item ) {
					return $value->activity_id == $item->id;
				} );
				$activity        = ActivityModel::find( $item->activity_id );
				$item->completed = is_numeric( $isCompleted );
				$item->activity  = EloquentPropertyUtil::build( $activity );
				if ( $nextActivity == null && ! $item->completed ) {
					$nextActivity = $item->activity;
					$nextActivity->day = $item->day;
					$nextActivity->pending = $activities->count()-$activitiesCompleted->count();
					break;
				}
			}
		}

		return $nextActivity;
	}

}