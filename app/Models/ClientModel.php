<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Client",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="dni",
 *          description="dni",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="last_name",
 *          description="last_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone_number",
 *          description="phone_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_url",
 *          description="image_url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="membership_number",
 *          description="membership_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="client_status_id",
 *          description="client_status_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="birth_date",
 *          description="birth_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="email_verified_at",
 *          description="email_verified_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
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
class ClientModel extends Model
{

	use SoftDeletes;

	public $table = 'clients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'dni',
        'name',
        'last_name',
        'phone_number',
        'email',
        'code',
        'image_url',
        'membership_number',
        'client_status_id',
        'birth_date',
        'email_verified_at',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'integer',
        'name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'code' => 'string',
        'image_url' => 'string',
        'membership_number' => 'string',
        'client_status_id' => 'integer',
        'birth_date' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required',
        'name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function getBirthDateAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->format('Y-m-d');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function client_status()
    {
        return $this->belongsTo(\App\Models\ClientStatusModel::class, 'client_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function class_reservations()
    {
        return $this->hasMany(\App\Models\ClassReservationModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function client_activities()
    {
        return $this->hasMany(\App\Models\ClientActivityModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function routine_clients()
    {
        return $this->hasMany(\App\Models\RoutineClientModel::class);
    }
}
