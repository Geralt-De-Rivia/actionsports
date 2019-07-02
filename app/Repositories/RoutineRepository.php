<?php

namespace App\Repositories;

use App\Models\RoutineModel;
use Illuminate\Support\Facades\DB;
use App\Models\RoutineActivityModel;
use App\Repositories\BaseRepository;

/**
 * Class RoutineRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:34 pm UTC
*/

class RoutineRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'days',
        'difficulty'
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
        return RoutineModel::class;
    }

    public function create(array $input)
    {
        $model = parent::create($input);

        $itemValues = $input['recurrenceItems'];
        if ($itemValues > 0) {
            for ($i = 1; $i <= $itemValues; $i++) {
                if (isset($input['day_' . $i]) && isset($input['activity_' . $i])) {
                    $day = $input['day_' . $i];
                    $activity = $input['activity_' . $i];
                    $recurrence = new RoutineActivityModel();
                    $recurrence->routine_id = $model->id;
                    $recurrence->day = $day;
                    $recurrence->activity_id = $activity;
                    $recurrence->save();
                }
            }
        }
        return $model;

    }

    public function update(array $input, $id)
    {
        $model = parent::update($input, $id);

        DB::table('routine_activities')->where('routine_id','=',$id)->delete();

        $itemValues = $input['recurrenceItems'];
        if ($itemValues > 0) {
            for ($i = 1; $i <= $itemValues; $i++) {
                if (isset($input['day_' . $i]) && isset($input['activity_' . $i])) {
                    $day = $input['day_' . $i];
                    $activity = $input['activity_' . $i];
                    $recurrence = new RoutineActivityModel();
                    $recurrence->routine_id = $model->id;
                    $recurrence->day = $day;
                    $recurrence->activity_id = $activity;
                    $recurrence->save();
                }
            }
        }
        return $model;

    }
}
