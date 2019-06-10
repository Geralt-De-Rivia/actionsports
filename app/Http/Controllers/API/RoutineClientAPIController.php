<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoutineClientAPIRequest;
use App\Http\Requests\API\UpdateRoutineClientAPIRequest;
use App\Models\RoutineClientModel;
use App\Repositories\RoutineClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
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
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineClients",
     *      summary="Get a listing of the RoutineClients.",
     *      tags={"RoutineClient"},
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
     *                  @SWG\Items(ref="#/definitions/RoutineClient")
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
        $routineClients = $this->routineClientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($routineClients->toArray(), 'Routine Clients retrieved successfully');
    }

    /**
     * @param CreateRoutineClientAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/routineClients",
     *      summary="Store a newly created RoutineClient in storage",
     *      tags={"RoutineClient"},
     *      description="Store RoutineClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineClient that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineClient")
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
     *                  ref="#/definitions/RoutineClient"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRoutineClientAPIRequest $request)
    {
        $input = $request->all();

        $routineClient = $this->routineClientRepository->create($input);

        return $this->sendResponse($routineClient->toArray(), 'Routine Client saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineClients/{id}",
     *      summary="Display the specified RoutineClient",
     *      tags={"RoutineClient"},
     *      description="Get RoutineClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineClient",
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
     *                  ref="#/definitions/RoutineClient"
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

    /**
     * @param int $id
     * @param UpdateRoutineClientAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/routineClients/{id}",
     *      summary="Update the specified RoutineClient in storage",
     *      tags={"RoutineClient"},
     *      description="Update RoutineClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineClient",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineClient that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineClient")
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
     *                  ref="#/definitions/RoutineClient"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRoutineClientAPIRequest $request)
    {
        $input = $request->all();

        /** @var RoutineClientModel $routineClient */
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            return $this->sendError('Routine Client not found');
        }

        $routineClient = $this->routineClientRepository->update($input, $id);

        return $this->sendResponse($routineClient->toArray(), 'RoutineClient updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/routineClients/{id}",
     *      summary="Remove the specified RoutineClient from storage",
     *      tags={"RoutineClient"},
     *      description="Delete RoutineClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineClient",
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
        /** @var RoutineClientModel $routineClient */
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            return $this->sendError('Routine Client not found');
        }

        $routineClient->delete();

        return $this->sendResponse($id, 'Routine Client deleted successfully');
    }
}
