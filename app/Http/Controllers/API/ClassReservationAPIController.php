<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateClassReservationAPIRequest;
use App\Http\Requests\API\UpdateClassReservationAPIRequest;
use App\Models\ClassReservationModel;
use App\Repositories\ClassReservationRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ClassReservationController
 * @package App\Http\Controllers\API
 */
class ClassReservationAPIController extends AppBaseController
{
    /** @var  ClassReservationRepository */
    private $classReservationRepository;

    public function __construct(ClassReservationRepository $classReservationRepo)
    {
        $this->classReservationRepository = $classReservationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classReservations",
     *      summary="Get a listing of the ClassReservations.",
     *      tags={"ClassReservation"},
     *      description="Get all ClassReservations",
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
     *                  @SWG\Items(ref="#/definitions/ClassReservation")
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
        $classReservations = $this->classReservationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classReservations->toArray(), 'Class Reservations retrieved successfully');
    }

    /**
     * @param CreateClassReservationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classReservations",
     *      summary="Store a newly created ClassReservation in storage",
     *      tags={"ClassReservation"},
     *      description="Store ClassReservation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassReservation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassReservation")
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
     *                  ref="#/definitions/ClassReservation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClassReservationAPIRequest $request)
    {
        try {
            $input = $request->all();

            $classReservation = $this->classReservationRepository->create($input);

            return $this->sendResponse($classReservation->toArray(), 'Class Reservation saved successfully');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(), 200);
        }

    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classReservations/{id}",
     *      summary="Display the specified ClassReservation",
     *      tags={"ClassReservation"},
     *      description="Get ClassReservation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassReservation",
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
     *                  ref="#/definitions/ClassReservation"
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
        /** @var ClassReservationModel $classReservation */
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            return $this->sendError('Class Reservation not found');
        }

        return $this->sendResponse($classReservation->toArray(), 'Class Reservation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClassReservationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classReservations/{id}",
     *      summary="Update the specified ClassReservation in storage",
     *      tags={"ClassReservation"},
     *      description="Update ClassReservation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassReservation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassReservation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassReservation")
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
     *                  ref="#/definitions/ClassReservation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClassReservationAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClassReservationModel $classReservation */
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            return $this->sendError('Class Reservation not found');
        }

        $classReservation = $this->classReservationRepository->update($input, $id);

        return $this->sendResponse($classReservation->toArray(), 'ClassReservation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classReservations/{id}",
     *      summary="Remove the specified ClassReservation from storage",
     *      tags={"ClassReservation"},
     *      description="Delete ClassReservation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassReservation",
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
        /** @var ClassReservationModel $classReservation */
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            return $this->sendError('Class Reservation not found');
        }

        $classReservation->delete();

        return $this->sendResponse($id, 'Class Reservation deleted successfully');
    }
}
