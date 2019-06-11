<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMachineAPIRequest;
use App\Http\Requests\API\UpdateMachineAPIRequest;
use App\Models\MachineModel;
use App\Repositories\MachineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MachineController
 * @package App\Http\Controllers\API
 */

class MachineAPIController extends AppBaseController
{
    /** @var  MachineRepository */
    private $machineRepository;

    public function __construct(MachineRepository $machineRepo)
    {
        $this->machineRepository = $machineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/machines",
     *      summary="Get a listing of the Machines.",
     *      tags={"MachineModel"},
     *      description="Get all Machines",
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
     *                  @SWG\Items(ref="#/definitions/MachineModel")
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
        $machines = $this->machineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($machines->toArray(), 'Machines retrieved successfully');
    }

    /**
     * @param CreateMachineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/machines",
     *      summary="Store a newly created MachineModel in storage",
     *      tags={"MachineModel"},
     *      description="Store MachineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MachineModel that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MachineModel")
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
     *                  ref="#/definitions/MachineModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMachineAPIRequest $request)
    {
        $input = $request->all();

        $machine = $this->machineRepository->create($input);

        return $this->sendResponse($machine->toArray(), 'MachineModel saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/machines/{id}",
     *      summary="Display the specified MachineModel",
     *      tags={"MachineModel"},
     *      description="Get MachineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MachineModel",
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
     *                  ref="#/definitions/MachineModel"
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
        /** @var MachineModel $machine */
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            return $this->sendError('MachineModel not found');
        }

        return $this->sendResponse($machine->toArray(), 'MachineModel retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMachineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/machines/{id}",
     *      summary="Update the specified MachineModel in storage",
     *      tags={"MachineModel"},
     *      description="Update MachineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MachineModel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MachineModel that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MachineModel")
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
     *                  ref="#/definitions/MachineModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMachineAPIRequest $request)
    {
        $input = $request->all();

        /** @var MachineModel $machine */
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            return $this->sendError('MachineModel not found');
        }

        $machine = $this->machineRepository->update($input, $id);

        return $this->sendResponse($machine->toArray(), 'MachineModel updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/machines/{id}",
     *      summary="Remove the specified MachineModel from storage",
     *      tags={"MachineModel"},
     *      description="Delete MachineModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MachineModel",
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
        /** @var MachineModel $machine */
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            return $this->sendError('MachineModel not found');
        }

        $machine->delete();

        return $this->sendResponse($id, 'MachineModel deleted successfully');
    }
}
