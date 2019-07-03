<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\Models\ActivityModel;
use App\DataTables\RoutineDataTable;
use App\Repositories\RoutineRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use App\Infrastructure\Repositories\Criterias\WithRelationshipsCriteria;

class RoutineController extends AppBaseController
{
    /** @var  RoutineRepository */
    private $routineRepository;

    public function __construct(RoutineRepository $routineRepo)
    {
        $this->routineRepository = $routineRepo;
    }

    /**
     * Display a listing of the RoutineModel.
     *
     * @param RoutineDataTable $routineDataTable
     * @return Response
     */
    public function index(RoutineDataTable $routineDataTable)
    {
        return $routineDataTable->render('routines.index');
    }

    /**
     * Show the form for creating a new RoutineModel.
     *
     * @return Response
     */
    public function create()
    {
        $activitys = ActivityModel::all()->pluck('name','id');

        return view('routines.create')
            ->with('activitys', $activitys);
    }

    /**
     * Store a newly created RoutineModel in storage.
     *
     * @param CreateRoutineRequest $request
     *
     * @return Response
     */
    public function store(CreateRoutineRequest $request)
    {
        $input = $request->all();

        $routine = $this->routineRepository->create($input);

        Flash::success('Rutina Guardada Satisfactoriamente.');

        return redirect(route('routines.index'));
    }

    /**
     * Display the specified RoutineModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->routineRepository
            ->pushCriteria(new WithRelationshipsCriteria(['routineActivities']));
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines.index'));
        }

        return view('routines.show')->with('routine', $routine);
    }

    /**
     * Show the form for editing the specified RoutineModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activitys = ActivityModel::all()->pluck('name','id');

        $this->routineRepository->pushCriteria(new WithRelationshipsCriteria(['routineActivities']));
        $routine = $this->routineRepository->find($id);


        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines.index'));
        }

        //return Response::json([$routine,$routine->routineActivities]);

        return view('routines.edit')->with('routine', $routine)
            ->with('activitys', $activitys);
    }

    /**
     * Update the specified RoutineModel in storage.
     *
     * @param  int              $id
     * @param UpdateRoutineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoutineRequest $request)
    {
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines.index'));
        }

        $routine = $this->routineRepository->update($request->all(), $id);

        Flash::success('RoutineModel updated successfully.');

        return redirect(route('routines.index'));
    }

    /**
     * Remove the specified RoutineModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $routine = $this->routineRepository->find($id);

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines.index'));
        }

        $this->routineRepository->delete($id);

        Flash::success('RoutineModel deleted successfully.');

        return redirect(route('routines.index'));
    }
}
