<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassScheduleAPIRequest;
use App\Http\Requests\API\UpdateClassScheduleAPIRequest;
use App\Models\ClassScheduleModel;
use App\Repositories\ClassScheduleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassScheduleController
 * @package App\Http\Controllers\API
 */

class ClassScheduleAPIController extends AppBaseController
{
    /** @var  ClassScheduleRepository */
    private $classScheduleRepository;

    public function __construct(ClassScheduleRepository $classScheduleRepo)
    {
        $this->classScheduleRepository = $classScheduleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classSchedules",
     *      summary="Get a listing of the ClassSchedules.",
     *      tags={"ClassSchedule"},
     *      description="Get all ClassSchedules",
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
     *                  @SWG\Items(ref="#/definitions/ClassSchedule")
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
        $classSchedules = $this->classScheduleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classSchedules->toArray(), 'Class Schedules retrieved successfully');
    }

    /**
     * @param CreateClassScheduleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classSchedules",
     *      summary="Store a newly created ClassSchedule in storage",
     *      tags={"ClassSchedule"},
     *      description="Store ClassSchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassSchedule that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassSchedule")
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
     *                  ref="#/definitions/ClassSchedule"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClassScheduleAPIRequest $request)
    {
        $input = $request->all();

        $classSchedule = $this->classScheduleRepository->create($input);

        return $this->sendResponse($classSchedule->toArray(), 'Class Schedule saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classSchedules/{id}",
     *      summary="Display the specified ClassSchedule",
     *      tags={"ClassSchedule"},
     *      description="Get ClassSchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassSchedule",
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
     *                  ref="#/definitions/ClassSchedule"
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
        /** @var ClassScheduleModel $classSchedule */
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            return $this->sendError('Class Schedule not found');
        }

        return $this->sendResponse($classSchedule->toArray(), 'Class Schedule retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClassScheduleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classSchedules/{id}",
     *      summary="Update the specified ClassSchedule in storage",
     *      tags={"ClassSchedule"},
     *      description="Update ClassSchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassSchedule",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassSchedule that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassSchedule")
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
     *                  ref="#/definitions/ClassSchedule"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClassScheduleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClassScheduleModel $classSchedule */
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            return $this->sendError('Class Schedule not found');
        }

        $classSchedule = $this->classScheduleRepository->update($input, $id);

        return $this->sendResponse($classSchedule->toArray(), 'ClassSchedule updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classSchedules/{id}",
     *      summary="Remove the specified ClassSchedule from storage",
     *      tags={"ClassSchedule"},
     *      description="Delete ClassSchedule",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassSchedule",
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
        /** @var ClassScheduleModel $classSchedule */
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            return $this->sendError('Class Schedule not found');
        }

        $classSchedule->delete();

        return $this->sendResponse($id, 'Class Schedule deleted successfully');
    }
}
