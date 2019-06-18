<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;

/**
 * @SWG\Definition(
 *      definition="Class",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="minutes",
 *          description="minutes",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="reservable",
 *          description="reservable",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="class_type_id",
 *          description="class_type_id",
 *          type="integer",
 *          format="int32"
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
class ClassModel extends Model
{

    public $table = 'classes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'minutes',
        'status',
        'reservable',
        'class_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'minutes' => 'integer',
        'status' => 'boolean',
        'reservable' => 'boolean',
        'class_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'minutes' => 'required',
        'status' => 'required',
        'reservable' => 'required',
        'class_type_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function classType()
    {
        return $this->belongsTo(\App\Models\ClassTypeModel::class, 'class_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function classSchedules()
    {
        return $this->hasMany(\App\Models\ClassScheduleModel::class);
    }

    public function properties(){
        $properties = DB::table('properties')
            ->join('keys', 'keys.id', '=', 'properties.key_id')
            ->select('keys.label', 'keys.type', 'properties.value')
            ->where('properties.model_id', '=', $this->id)
            ->where('keys.model', '=', '\\' . $this->getMorphClass())
            ->get();

        return $properties;
    }
}
