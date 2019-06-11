<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientActivityAPIRequest;
use App\Http\Requests\API\UpdateClientActivityAPIRequest;
use App\Models\ClientActivityModel;
use App\Repositories\ClientActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClientActivityController
 * @package App\Http\Controllers\API
 */

class ClientActivityAPIController extends AppBaseController
{
    /** @var  ClientActivityRepository */
    private $clientActivityRepository;

    public function __construct(ClientActivityRepository $clientActivityRepo)
    {
        $this->clientActivityRepository = $clientActivityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/clientActivities",
     *      summary="Get a listing of the ClientActivities.",
     *      tags={"ClientActivity"},
     *      description="Get all ClientActivities",
     *      produces={"application/json"},
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ClientActivity")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $clientActivities = $this->clientActivityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($clientActivities->toArray(), 'Client Activities retrieved successfully');
    }

    /**
     * @param CreateClientActivityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/clientActivities",
     *      summary="Store a newly created ClientActivity in storage",
     *      tags={"ClientActivity"},
     *      description="Store ClientActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClientActivity that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClientActivity")
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
     *                  ref="#/definitions/ClientActivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClientActivityAPIRequest $request)
    {
        $input = $request->all();

        $clientActivity = $this->clientActivityRepository->create($input);

        return $this->sendResponse($clientActivity->toArray(), 'Client Activity saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/clientActivities/{id}",
     *      summary="Display the specified ClientActivity",
     *      tags={"ClientActivity"},
     *      description="Get ClientActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClientActivity",
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
     *                  ref="#/definitions/ClientActivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ClientActivityModel $clientActivity */
        $clientActivity = $this->clientActivityRepository->find($id);

        if (empty($clientActivity)) {
            return $this->sendError('Client Activity not found');
        }

        return $this->sendResponse($clientActivity->toArray(), 'Client Activity retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClientActivityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/clientActivities/{id}",
     *      summary="Update the specified ClientActivity in storage",
     *      tags={"ClientActivity"},
     *      description="Update ClientActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClientActivity",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClientActivity that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClientActivity")
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
     *                  ref="#/definitions/ClientActivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClientActivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClientActivityModel $clientActivity */
        $clientActivity = $this->clientActivityRepository->find($id);

        if (empty($clientActivity)) {
            return $this->sendError('Client Activity not found');
        }

        $clientActivity = $this->clientActivityRepository->update($input, $id);

        return $this->sendResponse($clientActivity->toArray(), 'ClientActivity updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/clientActivities/{id}",
     *      summary="Remove the specified ClientActivity from storage",
     *      tags={"ClientActivity"},
     *      description="Delete ClientActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClientActivity",
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ClientActivityModel $clientActivity */
        $clientActivity = $this->clientActivityRepository->find($id);

        if (empty($clientActivity)) {
            return $this->sendError('Client Activity not found');
        }

        $clientActivity->delete();

        return $this->sendResponse($id, 'Client Activity deleted successfully');
    }
}
