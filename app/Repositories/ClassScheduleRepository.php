<?php

namespace App\Repositories;

use App\Models\ClassScheduleModel;
use App\Models\ClassScheduleRecurrenceModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class ClassScheduleRepository
 * @package App\Repositories
 * @version June 11, 2019, 6:00 pm UTC
 */
class ClassScheduleRepository extends \Prettus\Repository\Eloquent\BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'class_id',
        'user_id',
        'quota_min',
        'quota_max',
        'start_at',
        'end_at',
        'status',
        'recurrence'
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
        return ClassScheduleModel::class;
    }

    public function create(array $input)
    {
        $model = parent::create($input);

        $itemValues = $input['recurrenceItems'];
        if ($itemValues > 0) {
            for ($i = 1; $i <= $itemValues; $i++) {
                if (isset($input['day_' . $i]) && isset($input['hour_' . $i])) {
                    $day = $input['day_' . $i];
                    $time = Carbon::parse($input['hour_' . $i]);
                    $recurrence = new ClassScheduleRecurrenceModel();
                    $recurrence->class_schedule_id = $model->id;
                    $recurrence->day = $day;
                    $recurrence->start_time = $time;
                    $recurrence->save();
                }
            }
        }
        return $model;

    }

    public function update(array $input, $id)
    {
        $model = parent::update($input, $id);

        DB::table('class_schedule_recurrences')->where('class_schedule_id','=',$id)->delete();

        $itemValues = $input['recurrenceItems'];
        if ($itemValues > 0) {
            for ($i = 1; $i <= $itemValues; $i++) {
                if (isset($input['day_' . $i]) && isset($input['hour_' . $i])) {
                    $day = $input['day_' . $i];
                    $time = Carbon::parse($input['hour_' . $i]);
                    $recurrence = new ClassScheduleRecurrenceModel();
                    $recurrence->class_schedule_id = $model->id;
                    $recurrence->day = $day;
                    $recurrence->start_time = $time;
                    $recurrence->save();
                }
            }
        }
        return $model;

    }
}
