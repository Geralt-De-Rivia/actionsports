<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassTypeAPIRequest;
use App\Http\Requests\API\UpdateClassTypeAPIRequest;
use App\Models\ClassTypeModel;
use App\Repositories\ClassTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassTypeController
 * @package App\Http\Controllers\API
 */

class ClassTypeAPIController extends AppBaseController
{
    /** @var  ClassTypeRepository */
    private $classTypeRepository;

    public function __construct(ClassTypeRepository $classTypeRepo)
    {
        $this->classTypeRepository = $classTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classTypes",
     *      summary="Get a listing of the ClassTypes.",
     *      tags={"ClassType"},
     *      description="Get all ClassTypes",
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
     *                  @SWG\Items(ref="#/definitions/ClassType")
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
        $classTypes = $this->classTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classTypes->toArray(), 'Class Types retrieved successfully');
    }

    /**
     * @param CreateClassTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classTypes",
     *      summary="Store a newly created ClassType in storage",
     *      tags={"ClassType"},
     *      description="Store ClassType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassType")
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
     *                  ref="#/definitions/ClassType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClassTypeAPIRequest $request)
    {
        $input = $request->all();

        $classType = $this->classTypeRepository->create($input);

        return $this->sendResponse($classType->toArray(), 'Class Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classTypes/{id}",
     *      summary="Display the specified ClassType",
     *      tags={"ClassType"},
     *      description="Get ClassType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassType",
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
     *                  ref="#/definitions/ClassType"
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
        /** @var ClassTypeModel $classType */
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            return $this->sendError('Class Type not found');
        }

        return $this->sendResponse($classType->toArray(), 'Class Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClassTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classTypes/{id}",
     *      summary="Update the specified ClassType in storage",
     *      tags={"ClassType"},
     *      description="Update ClassType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClassType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClassType")
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
     *                  ref="#/definitions/ClassType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClassTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClassTypeModel $classType */
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            return $this->sendError('Class Type not found');
        }

        $classType = $this->classTypeRepository->update($input, $id);

        return $this->sendResponse($classType->toArray(), 'ClassType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classTypes/{id}",
     *      summary="Remove the specified ClassType from storage",
     *      tags={"ClassType"},
     *      description="Delete ClassType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClassType",
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
        /** @var ClassTypeModel $classType */
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            return $this->sendError('Class Type not found');
        }

        $classType->delete();

        return $this->sendResponse($id, 'Class Type deleted successfully');
    }
}
