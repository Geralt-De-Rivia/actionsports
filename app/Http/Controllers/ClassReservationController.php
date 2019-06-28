<?php

namespace App\Http\Controllers;

use App\DataTables\ClassReservationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateClassReservationRequest;
use App\Http\Requests\UpdateClassReservationRequest;
use App\Repositories\ClassReservationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ClassReservationController extends AppBaseController
{
    /** @var  ClassReservationRepository */
    private $classReservationRepository;

    public function __construct(ClassReservationRepository $classReservationRepo)
    {
        $this->classReservationRepository = $classReservationRepo;
    }

    /**
     * Display a listing of the ClassReservation.
     *
     * @param ClassReservationDataTable $classReservationDataTable
     * @return Response
     */
    public function index(ClassReservationDataTable $classReservationDataTable)
    {
        return $classReservationDataTable->render('class_reservations.index');
    }

    /**
     * Show the form for creating a new ClassReservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_reservations.create');
    }

    /**
     * Store a newly created ClassReservation in storage.
     *
     * @param CreateClassReservationRequest $request
     *
     * @return Response
     */
    public function store(CreateClassReservationRequest $request)
    {
        $input = $request->all();

        $classReservation = $this->classReservationRepository->create($input);

        Flash::success('Class Reservation saved successfully.');

        return redirect(route('classReservations.index'));
    }

    /**
     * Display the specified ClassReservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            Flash::error('Class Reservation not found');

            return redirect(route('classReservations.index'));
        }

        return view('class_reservations.show')->with('classReservation', $classReservation);
    }

    /**
     * Show the form for editing the specified ClassReservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            Flash::error('Class Reservation not found');

            return redirect(route('classReservations.index'));
        }

        return view('class_reservations.edit')->with('classReservation', $classReservation);
    }

    /**
     * Update the specified ClassReservation in storage.
     *
     * @param  int              $id
     * @param UpdateClassReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassReservationRequest $request)
    {
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            Flash::error('Class Reservation not found');

            return redirect(route('classReservations.index'));
        }

        $classReservation = $this->classReservationRepository->update($request->all(), $id);

        Flash::success('Class Reservation updated successfully.');

        return redirect(route('classReservations.index'));
    }

    /**
     * Remove the specified ClassReservation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classReservation = $this->classReservationRepository->find($id);

        if (empty($classReservation)) {
            Flash::error('Class Reservation not found');

            return redirect(route('classReservations.index'));
        }

        $this->classReservationRepository->delete($id);

        Flash::success('Class Reservation deleted successfully.');

        return redirect(route('classReservations.index'));
    }
}
