<?php

namespace App\Repositories;

use App\Models\RoutineActivityModel;
use App\Models\RoutineClientModel;
use App\Util\ClassActivityService;
use App\Util\EloquentPropertyUtil;
use Carbon\Carbon;

/**
 * Class RoutineClientRepository
 * @package App\Repositories
 * @version June 19, 2019, 4:16 pm -05
 */
class RoutineClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'routine_id',
        'user_id',
        'client_id',
        'start_at',
        'end_at',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RoutineClientModel::class;
    }

    public function currentRoutine($clientId)
    {

        $now = Carbon::now();
        $routine = RoutineClientModel::with('user')
            ->where(function ($query) use ($now) {
                $query->where('start_at', '<=', $now)
                    ->orWhere('end_at', '>=', $now);
            })
            ->where('status', '=', 1)
            ->orderBy('start_at')
            ->get()
            ->first();

        $service = new ClassActivityService();

        $activities = $service->getRoundActivity($clientId, $routine->routine_id);

        $routine->items = $activities;

        return $routine;
    }

	public function nextActivity($clientId)
	{

		$now = Carbon::now();
		$routine = RoutineClientModel::with('user')
		                             ->where(function ($query) use ($now) {
			                             $query->where('start_at', '<=', $now)
			                                   ->orWhere('end_at', '>=', $now);
		                             })
		                             ->where('status', '=', 1)
		                             ->orderBy('start_at')
		                             ->get()
		                             ->first();

		$service = new ClassActivityService();

		$activities = $service->nextActivity($clientId, $routine->routine_id);

		return $activities;
	}
}
