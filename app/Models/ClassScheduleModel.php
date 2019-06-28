<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="ClassSchedule",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="class_id",
 *          description="class_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="quota_min",
 *          description="quota_min",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="quota_max",
 *          description="quota_max",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_at",
 *          description="start_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="end_at",
 *          description="end_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="recurrence",
 *          description="recurrence",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class ClassScheduleModel extends Model
{
	use SoftDeletes;


	public $table = 'class_schedules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class_id' => 'integer',
        'user_id' => 'integer',
        'quota_min' => 'integer',
        'quota_max' => 'integer',
        'status' => 'boolean',
        'recurrence' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'class_id' => 'required',
        'user_id' => 'required',
        'quota_min' => 'required',
        'quota_max' => 'required',
        'status' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function class()
    {
        return $this->belongsTo(\App\Models\ClassModel::class, 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\UserModel::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function classReservations()
    {
        return $this->hasMany(\App\Models\ClassReservationModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function classScheduleRecurrences()
    {
        return $this->hasMany(\App\Models\ClassScheduleRecurrenceModel::class,'class_schedule_id','id');
    }

    public function getStartAtAttribute()
    {

        if(is_null($this->attributes['start_at'])){
            return null;
        }
        return Carbon::parse($this->attributes['start_at'])->format('Y-m-d');
    }

    public function getEndAtAttribute()
    {

        if(is_null($this->attributes['end_at'])){
            return null;
        }
        return Carbon::parse($this->attributes['end_at'])->format('Y-m-d');
    }


}
