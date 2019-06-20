<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientAPIRequest;
use App\Http\Requests\API\UpdateClientAPIRequest;
use App\Models\ClientModel;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClientController
 * @package App\Http\Controllers\API
 */

class ClientAPIController extends AppBaseController
{
    /** @var  ClientRepository */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }


	/**
	 * @param $clientId
	 *
	 * @return Response
	 *
	 * @SWG\Get(
	 *      path="/clients/{id}",
	 *      summary="Display the specified Client",
	 *      tags={"Client"},
	 *      description="Get Client",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="id of Client",
	 *          type="integer",
	 *          required=true,
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Client"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
    public function show($clientId)
    {
        /** @var ClientModel $client */
        $client = $this->clientRepository->find($clientId);

	    if (empty($client)) {
		    return $this->sendError('Client not found');
	    }

        $data = $this->clientRepository->getClientActivities($clientId);


        return $this->sendResponse($data, 'Client retrieved successfully');
    }

	/**
	 * @param CreateClientAPIRequest $request
	 * @return Response
	 *
	 * @SWG\Post(
	 *      path="/clients",
	 *      summary="Store a newly created Client in storage",
	 *      tags={"Client"},
	 *      description="Store Client",
	 *      produces={"application/json"},
	 *      @SWG\Parameter(
	 *          name="body",
	 *          in="body",
	 *          description="Client that should be stored",
	 *          required=false,
	 *          @SWG\Schema(ref="#/definitions/Client")
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="successful operation",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="success",
	 *                  type="boolean"
	 *              ),
	 *              @SWG\Property(
	 *                  property="data",
	 *                  ref="#/definitions/Client"
	 *              ),
	 *              @SWG\Property(
	 *                  property="message",
	 *                  type="string"
	 *              )
	 *          )
	 *      )
	 * )
	 */
	public function store(CreateClientAPIRequest $request)
	{
		$input = $request->all();

		$client = $this->clientRepository->create($input);

		return $this->sendResponse($client->toArray(), 'Client saved successfully');
	}

}
