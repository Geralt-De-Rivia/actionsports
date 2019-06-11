<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Key",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="label",
 *          description="label",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="model",
 *          description="model",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reference",
 *          description="reference",
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
class KeyModel extends Model
{

    public $table = 'keys';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static $TYPES = [
        [
            'id' => 'text',
            'label' => 'Texto'
        ],
        [
            'id' => 'number',
            'label' => 'Número'
        ],
        [
            'id' => 'color',
            'label' => 'Color'
        ]
        , [
            'id' => 'link',
            'label' => 'Link'
        ],
        [
            'id' => 'image',
            'label' => 'Imagén'
        ]
    ];

    public static $MODELS = [
        [
            'id' => '\App\Models\ActivityModel',
            'reference' => 'activities',
            'label' => 'Actividades'
        ],
        [
            'id' => '\App\Models\MachineModel',
            'reference' => 'machines',
            'label' => 'Equipos de Gimnasio'
        ],
        [
            'id' => '\App\Models\NewModel',
            'reference' => 'news',
            'label' => 'Novedades'
        ]
        , [
            'id' => '\App\Models\ClassModel',
            'reference' => 'classes',
            'label' => 'Clases'
        ]
    ];


    public $fillable = [
        'type',
        'label',
        'model',
        'reference'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'label' => 'string',
        'model' => 'string',
        'reference' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'label' => 'required',
        'model' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function properties()
    {
        return $this->hasMany(\App\Models\Property::class);
    }
}
