<?php

namespace App\Repositories;

use App\Models\ClientModel;
use App\Util\EloquentPropertyUtil;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:33 pm UTC
 */
class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return ClientModel::class;
    }

    public function create($input)
    {
        $input['client_status_id'] = 1;
        $input['membership_number'] = $input['dni'];
        return parent::create($input);
    }

    public function login($memberShipNumber, $code)
    {
        $client = ClientModel::where('membership_number', '=', $memberShipNumber)
            ->where('code', '=', $code)
            ->get()
            ->first();

        if (empty($client)) {
            throw new \Exception("El cliente no existe");
        }

        if ($client->client_status_id == 1) {
            throw new \Exception("El cliente se encuentra en estado preinscrito");
        }

        if ($client->client_status_id == 3) {
            throw new \Exception("El cliente se encuentra suspendido");
        }

        return $client;
    }

    public function getClientActivities($clientId){

    	$activities = DB::select("
				SELECT count(*) as number,ca.activity_id as activity_id
				FROM `client_activities` ca 
				INNER JOIN activities a ON (ca.activity_id = a.id) 
				WHERE ca.client_id = :clientId
				GROUP BY ca.activity_id",[
					'clientId' => $clientId
	    ]);
    	$response = new \stdClass();
	    $response->force = 0;
	    $response->time = 0;
	    $response->calories = 0;
    	foreach ($activities as $userActivity){
			$activity = EloquentPropertyUtil::getProperties($userActivity->activity_id,'App\Models\ActivityModel');
			$response->force = $activity->force * $userActivity->number;
			$response->time = $activity->duration * $userActivity->number;
			$response->calories = $activity->calories * $userActivity->number;
	    }
    	return $response;
    }
}
