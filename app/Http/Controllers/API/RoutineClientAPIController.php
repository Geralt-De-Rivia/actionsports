<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoutineClientAPIRequest;
use App\Http\Requests\API\UpdateRoutineClientAPIRequest;
use App\Models\RoutineClientModel;
use App\Models\RoutineModel;
use App\Repositories\RoutineClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\View\View;
use Response;

/**
 * Class RoutineClientController
 * @package App\Http\Controllers\API
 */

class RoutineClientAPIController extends AppBaseController
{
    /** @var  RoutineClientRepository */
    private $routineClientRepository;

    public function __construct(RoutineClientRepository $routineClientRepo)
    {
        $this->routineClientRepository = $routineClientRepo;
    }

    /**
     * @param $clientId
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineClients",
     *      summary="Get a listing of the RoutineClients.",
     *      tags={"RoutineClientModel"},
     *      description="Get all RoutineClients",
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
     *                  @SWG\Items(ref="#/definitions/RoutineClientModel")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index($clientId, Request $request)
    {
        $routineClients = $this->routineClientRepository->currentRoutine($clientId);

        return $this->sendResponse($routineClients->toArray(), 'Routine Clients retrieved successfully');
    }

    /**
     * @param $clientId
     * @param CreateRoutineClientAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/routineClients",
     *      summary="Store a newly created RoutineClientModel in storage",
     *      tags={"RoutineClientModel"},
     *      description="Store RoutineClientModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineClientModel that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineClientModel")
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
     *                  ref="#/definitions/RoutineClientModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store($clientId, CreateRoutineClientAPIRequest $request)
    {
        $input = $request->all();

        $input['client_id'] = $clientId;

        $routineClient = $this->routineClientRepository->create($input);

        return $this->sendResponse($routineClient->toArray(), 'Routine Client saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineClients/{id}",
     *      summary="Display the specified RoutineClientModel",
     *      tags={"RoutineClientModel"},
     *      description="Get RoutineClientModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineClientModel",
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
     *                  ref="#/definitions/RoutineClientModel"
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
        /** @var RoutineClientModel $routineClient */
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            return $this->sendError('Routine Client not found');
        }

        return $this->sendResponse($routineClient->toArray(), 'Routine Client retrieved successfully');
    }

}
