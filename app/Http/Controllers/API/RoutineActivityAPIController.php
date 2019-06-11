<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRoutineActivityAPIRequest;
use App\Http\Requests\API\UpdateRoutineActivityAPIRequest;
use App\Models\RoutineActivityModel;
use App\Repositories\RoutineActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RoutineActivityController
 * @package App\Http\Controllers\API
 */

class RoutineActivityAPIController extends AppBaseController
{
    /** @var  RoutineActivityRepository */
    private $routineActivityRepository;

    public function __construct(RoutineActivityRepository $routineActivityRepo)
    {
        $this->routineActivityRepository = $routineActivityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineActivities",
     *      summary="Get a listing of the RoutineActivities.",
     *      tags={"RoutineActivity"},
     *      description="Get all RoutineActivities",
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
     *                  @SWG\Items(ref="#/definitions/RoutineActivity")
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
        $routineActivities = $this->routineActivityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($routineActivities->toArray(), 'Routine Activities retrieved successfully');
    }

    /**
     * @param CreateRoutineActivityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/routineActivities",
     *      summary="Store a newly created RoutineActivity in storage",
     *      tags={"RoutineActivity"},
     *      description="Store RoutineActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineActivity that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineActivity")
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
     *                  ref="#/definitions/RoutineActivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRoutineActivityAPIRequest $request)
    {
        $input = $request->all();

        $routineActivity = $this->routineActivityRepository->create($input);

        return $this->sendResponse($routineActivity->toArray(), 'Routine Activity saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/routineActivities/{id}",
     *      summary="Display the specified RoutineActivity",
     *      tags={"RoutineActivity"},
     *      description="Get RoutineActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineActivity",
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
     *                  ref="#/definitions/RoutineActivity"
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
        /** @var RoutineActivityModel $routineActivity */
        $routineActivity = $this->routineActivityRepository->find($id);

        if (empty($routineActivity)) {
            return $this->sendError('Routine Activity not found');
        }

        return $this->sendResponse($routineActivity->toArray(), 'Routine Activity retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRoutineActivityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/routineActivities/{id}",
     *      summary="Update the specified RoutineActivity in storage",
     *      tags={"RoutineActivity"},
     *      description="Update RoutineActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineActivity",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RoutineActivity that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RoutineActivity")
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
     *                  ref="#/definitions/RoutineActivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRoutineActivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var RoutineActivityModel $routineActivity */
        $routineActivity = $this->routineActivityRepository->find($id);

        if (empty($routineActivity)) {
            return $this->sendError('Routine Activity not found');
        }

        $routineActivity = $this->routineActivityRepository->update($input, $id);

        return $this->sendResponse($routineActivity->toArray(), 'RoutineActivity updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/routineActivities/{id}",
     *      summary="Remove the specified RoutineActivity from storage",
     *      tags={"RoutineActivity"},
     *      description="Delete RoutineActivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RoutineActivity",
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
        /** @var RoutineActivityModel $routineActivity */
        $routineActivity = $this->routineActivityRepository->find($id);

        if (empty($routineActivity)) {
            return $this->sendError('Routine Activity not found');
        }

        $routineActivity->delete();

        return $this->sendResponse($id, 'Routine Activity deleted successfully');
    }
}
