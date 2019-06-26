<?php

namespace App\Http\Controllers;

use App\DataTables\RoutinesActiviyDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateRoutineActivityRequest;
use App\Http\Requests\UpdateRoutineActivityRequest;
use App\Repositories\RoutineActivityRepository;
use App\Models\ActivityModel;
use App\Models\RoutineModel;
use Flash;
use Response;

class RoutinesActivityController extends AppBaseController
{
    /** @var  RoutineActivityRepository */
    private $RoutineActivityRepository;

    public function __construct(RoutineActivityRepository $routineActivityRepo)
    {
        $this->RoutineActivityRepository = $routineActivityRepo;
    }

    /**
     * Display a listing of the RoutineModel.
     *
     * @param RoutineDataTable $routineDataTable
     * @return Response
     */
    public function index(RoutinesActiviyDataTable $routineActivityDataTable)
    {
        return $routineActivityDataTable->render('routines_activity.index');
    }

    /**
     * Show the form for creating a new RoutineModel.
     *
     * @return Response
     */
    public function create()
    {
        $activitys = ActivityModel::all()->pluck('name','id');
        $routine = RoutineModel::all()->pluck('name','id');
        return view('routines_activity.create')
            ->with('activitys', $activitys)
            ->with('routine', $routine);
    }

    /**
     * Store a newly created RoutineModel in storage.
     *
     * @param CreateRoutineRequest $request
     *
     * @return Response
     */
    public function store(CreateRoutineActivityRequest $request)
    {
        $input = $request->all();

        $routine = $this->RoutineActivityRepository->create($input);

        Flash::success('Rutina Guardada Satisfactoriamente.');

        return redirect(route('routines_activity.index'));
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
        $routines_activity = $this->RoutineActivityRepository->find($id);

        if (empty($routines_activity)) {
            Flash::error('RoutineActivityModel not found');

            return redirect(route('routines_activity.index'));
        }

        return view('routines_activity.show')->with('routines_activity', $routines_activity);
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
        $routines_activity = $this->RoutineActivityRepository->find($id);
        $activitys = ActivityModel::all()->pluck('name','id');
        $routine = RoutineModel::all()->pluck('name','id');

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines_activity.index'));
        }

        return view('routines_activity.edit')
            ->with('routines_activity', $routines_activity)
            ->with('activitys', $activitys)
            ->with('routine', $routine);
    }

    /**
     * Update the specified RoutineModel in storage.
     *
     * @param  int              $id
     * @param UpdateRoutineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoutineActivityRequest $request)
    {
        $routine = $this->RoutineActivityRepository->find($id);

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines_activity.index'));
        }

        $routine = $this->RoutineActivityRepository->update($request->all(), $id);

        Flash::success('RoutineModel updated successfully.');

        return redirect(route('routines_activity.index'));
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
        $routine = $this->RoutineActivityRepository->find($id);

        if (empty($routine)) {
            Flash::error('RoutineModel not found');

            return redirect(route('routines_activity.index'));
        }

        $this->RoutineActivityRepository->delete($id);

        Flash::success('RoutineModel deleted successfully.');

        return redirect(route('routines_activity.index'));
    }
}
