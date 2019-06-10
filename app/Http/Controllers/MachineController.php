<?php

namespace App\Http\Controllers;

use App\DataTables\MachineDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMachineRequest;
use App\Http\Requests\UpdateMachineRequest;
use App\Repositories\MachineRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MachineController extends AppBaseController
{
    /** @var  MachineRepository */
    private $machineRepository;

    public function __construct(MachineRepository $machineRepo)
    {
        $this->machineRepository = $machineRepo;
    }

    /**
     * Display a listing of the MachineModel.
     *
     * @param MachineDataTable $machineDataTable
     * @return Response
     */
    public function index(MachineDataTable $machineDataTable)
    {
        return $machineDataTable->render('machines.index');
    }

    /**
     * Show the form for creating a new MachineModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('machines.create');
    }

    /**
     * Store a newly created MachineModel in storage.
     *
     * @param CreateMachineRequest $request
     *
     * @return Response
     */
    public function store(CreateMachineRequest $request)
    {
        $input = $request->all();

        $machine = $this->machineRepository->create($input);

        Flash::success('MachineModel saved successfully.');

        return redirect(route('machines.index'));
    }

    /**
     * Display the specified MachineModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            Flash::error('MachineModel not found');

            return redirect(route('machines.index'));
        }

        return view('machines.show')->with('machine', $machine);
    }

    /**
     * Show the form for editing the specified MachineModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            Flash::error('MachineModel not found');

            return redirect(route('machines.index'));
        }

        return view('machines.edit')->with('machine', $machine);
    }

    /**
     * Update the specified MachineModel in storage.
     *
     * @param  int              $id
     * @param UpdateMachineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMachineRequest $request)
    {
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            Flash::error('MachineModel not found');

            return redirect(route('machines.index'));
        }

        $machine = $this->machineRepository->update($request->all(), $id);

        Flash::success('MachineModel updated successfully.');

        return redirect(route('machines.index'));
    }

    /**
     * Remove the specified MachineModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $machine = $this->machineRepository->find($id);

        if (empty($machine)) {
            Flash::error('MachineModel not found');

            return redirect(route('machines.index'));
        }

        $this->machineRepository->delete($id);

        Flash::success('MachineModel deleted successfully.');

        return redirect(route('machines.index'));
    }
}
