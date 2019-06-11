<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoutineAPIRequest;
use App\Http\Requests\API\UpdateRoutineAPIRequest;
use App\Models\RoutineModel;
use App\Repositories\RoutineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RoutineController
 * @package App\Http\Controllers\API
 */

class RoutineAPIController extends AppBaseController
{
    /** @var  RoutineRepository */
    private $routineRepository;

    public function __construct(RoutineRepository $routineRepo)
    {
        $this->routineRepository = $routineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/routines",
     *      summary="Get a listing of the Routines.",
     *      tags={"RoutineModel"},
     *      description="Get all Routines",
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
     *                  @SWG\Items(ref="#/definitions/RoutineModel")
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
        $routines = $this->routineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($routines->toArray(), 'Routines retrieved successfully');
    }

    /**
     * @param CreateRoutineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/routines",
     *      summary="Store a newly created RoutineModel in storage",
     *      tags={"RoutineModel"},
     *      description="Store RoutineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineModel that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineModel")
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
     *                  ref="#/definitions/RoutineModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRoutineAPIRequest $request)
    {
        $input = $request->all();

        $routine = $this->routineRepository->create($input);

        return $this->sendResponse($routine->toArray(), 'RoutineModel saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/routines/{id}",
     *      summary="Display the specified RoutineModel",
     *      tags={"RoutineModel"},
     *      description="Get RoutineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineModel",
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
     *                  ref="#/definitions/RoutineModel"
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
        /** @var RoutineModel $routine */
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            return $this->sendError('RoutineModel not found');
        }

        return $this->sendResponse($routine->toArray(), 'RoutineModel retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRoutineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/routines/{id}",
     *      summary="Update the specified RoutineModel in storage",
     *      tags={"RoutineModel"},
     *      description="Update RoutineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineModel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineModel that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineModel")
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
     *                  ref="#/definitions/RoutineModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRoutineAPIRequest $request)
    {
        $input = $request->all();

        /** @var RoutineModel $routine */
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            return $this->sendError('RoutineModel not found');
        }

        $routine = $this->routineRepository->update($input, $id);

        return $this->sendResponse($routine->toArray(), 'RoutineModel updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/routines/{id}",
     *      summary="Remove the specified RoutineModel from storage",
     *      tags={"RoutineModel"},
     *      description="Delete RoutineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineModel",
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
        /** @var RoutineModel $routine */
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            return $this->sendError('RoutineModel not found');
        }

        $routine->delete();

        return $this->sendResponse($id, 'RoutineModel deleted successfully');
    }
}
