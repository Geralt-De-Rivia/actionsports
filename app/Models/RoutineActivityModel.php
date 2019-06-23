<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;

/**
 * @SWG\Definition(
 *      definition="RoutineActivity",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="routine_id",
 *          description="routine_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="activity_id",
 *          description="activity_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="day",
 *          description="day",
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
class RoutineActivityModel extends Model
{

    public $table = 'routine_activities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'routine_id',
        'activity_id',
        'day'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'routine_id' => 'integer',
        'activity_id' => 'integer',
        'day' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'routine_id' => 'required',
        'activity_id' => 'required',
        'day' => 'required'
    ];

    public $appends = [
        'day_routine' 
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function activity()
    {
        return $this->belongsTo(\App\Models\ActivityModel::class, 'activity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function routine()
    {
        return $this->belongsTo(\App\Models\RoutineModel::class, 'routine_id');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function getDayRoutineAttribute()
    {
        switch($this->attributes['day']){
                    case 0:
                        return 'DOMINGO';
                    break;
                    case 1:
                        return 'LUNES';
                    break;
                    case 2:
                        return 'MARTES';
                    break;
                    case 3:
                        return 'MIERCOLES';
                    break;
                    case 4:
                        return 'JUEVES';
                    break;
                    case 5:
                        return 'VIERNES';
                    break;
                    case 6:
                        return 'SABADO';
                    break;
                }
    }
}
