<?php

namespace App\Http\Controllers;

use App\DataTables\ClassScheduleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateClassScheduleRequest;
use App\Http\Requests\UpdateClassScheduleRequest;
use App\Repositories\ClassScheduleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ClassScheduleController extends AppBaseController
{
    /** @var  ClassScheduleRepository */
    private $classScheduleRepository;

    public function __construct(ClassScheduleRepository $classScheduleRepo)
    {
        $this->classScheduleRepository = $classScheduleRepo;
    }

    /**
     * Display a listing of the ClassSchedule.
     *
     * @param ClassScheduleDataTable $classScheduleDataTable
     * @return Response
     */
    public function index(ClassScheduleDataTable $classScheduleDataTable)
    {
        return $classScheduleDataTable->render('class_schedules.index');
    }

    /**
     * Show the form for creating a new ClassSchedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_schedules.create');
    }

    /**
     * Store a newly created ClassSchedule in storage.
     *
     * @param CreateClassScheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateClassScheduleRequest $request)
    {
        $input = $request->all();

        $classSchedule = $this->classScheduleRepository->create($input);

        Flash::success('Horario de Clase Guardada Satisfactoriamente.');

        return redirect(route('classSchedules.index'));
    }

    /**
     * Display the specified ClassSchedule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        return view('class_schedules.show')->with('classSchedule', $classSchedule);
    }

    /**
     * Show the form for editing the specified ClassSchedule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        return view('class_schedules.edit')->with('classSchedule', $classSchedule);
    }

    /**
     * Update the specified ClassSchedule in storage.
     *
     * @param  int              $id
     * @param UpdateClassScheduleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassScheduleRequest $request)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        $classSchedule = $this->classScheduleRepository->update($request->all(), $id);

        Flash::success('Class Schedule updated successfully.');

        return redirect(route('classSchedules.index'));
    }

    /**
     * Remove the specified ClassSchedule from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classSchedule = $this->classScheduleRepository->find($id);

        if (empty($classSchedule)) {
            Flash::error('Class Schedule not found');

            return redirect(route('classSchedules.index'));
        }

        $this->classScheduleRepository->delete($id);

        Flash::success('Class Schedule deleted successfully.');

        return redirect(route('classSchedules.index'));
    }
}
