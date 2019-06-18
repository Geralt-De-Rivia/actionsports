<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassAPIRequest;
use App\Http\Requests\API\UpdateClassAPIRequest;
use App\Models\ClassModel;
use App\Repositories\ClassRepository;
use App\Repositories\ClassScheduleRepository;
use App\Util\ClassReservationService;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassController
 * @package App\Http\Controllers\API
 */

class ClassAPIController extends AppBaseController
{
    /** @var  ClassRepository */
    private $classRepository;

    private $classScheduleRepository;

    public function __construct(ClassRepository $classRepo, ClassScheduleRepository $classRepository)
    {
        $this->classRepository = $classRepo;
        $this->classScheduleRepository = $classRepository;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classes",
     *      summary="Get a listing of the Classes.",
     *      tags={"Class"},
     *      description="Get all Classes",
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
     *                  @SWG\Items(ref="#/definitions/Class")
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
        $classes = $this->classRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        return $this->sendResponse($classes->toArray(), 'Classes retrieved successfully');
    }



    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classes/{id}",
     *      summary="Display the specified Class",
     *      tags={"Class"},
     *      description="Get Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Class",
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
     *                  ref="#/definitions/Class"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function days($id)
    {
        /** @var Class $class */
        $class = $this->classRepository->find($id);

        $service = new ClassReservationService();

        $days = $service->getAvailableDays($id);

        if (empty($class)) {
            return $this->sendError('Class not found');
        }

        return $this->sendResponse($days, 'Class retrieved successfully');
    }


}
