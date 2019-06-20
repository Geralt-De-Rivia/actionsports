<?php

namespace App\Http\Controllers;

use App\DataTables\RoutineClientDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRoutineClientRequest;
use App\Http\Requests\UpdateRoutineClientRequest;
use App\Models\RoutineModel;
use App\Models\UserModel;
use App\Repositories\RoutineClientRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\View;
use Response;

class RoutineClientController extends AppBaseController
{
    /** @var  RoutineClientRepository */
    private $routineClientRepository;

    public function __construct(RoutineClientRepository $routineClientRepo)
    {
        $this->routineClientRepository = $routineClientRepo;

        $routines = RoutineModel::all()->pluck('name','id');

        $teachers = UserModel::where('role_id','=',2)->get()->pluck('name','id');

        View::share('routines', $routines);

        View::share('teachers', $teachers);

    }

    /**
     * Display a listing of the RoutineClientModel.
     *
     * @param RoutineClientDataTable $routineClientDataTable
     * @return Response
     */
    public function index(RoutineClientDataTable $routineClientDataTable)
    {
        return $routineClientDataTable->render('routine_clients.index');
    }

    /**
     * Show the form for creating a new RoutineClientModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('routine_clients.create');
    }

    /**
     * Store a newly created RoutineClientModel in storage.
     *
     * @param CreateRoutineClientRequest $request
     *
     * @return Response
     */
    public function store(CreateRoutineClientRequest $request)
    {
        $input = $request->all();

        $routineClient = $this->routineClientRepository->create($input);

        Flash::success('Routine Client saved successfully.');

        return redirect(route('routineClients.index'));
    }

    /**
     * Display the specified RoutineClientModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            Flash::error('Routine Client not found');

            return redirect(route('routineClients.index'));
        }

        return view('routine_clients.show')->with('routineClient', $routineClient);
    }

    /**
     * Show the form for editing the specified RoutineClientModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            Flash::error('Routine Client not found');

            return redirect(route('routineClients.index'));
        }

        return view('routine_clients.edit')->with('routineClient', $routineClient);
    }

    /**
     * Update the specified RoutineClientModel in storage.
     *
     * @param  int              $id
     * @param UpdateRoutineClientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoutineClientRequest $request)
    {
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            Flash::error('Routine Client not found');

            return redirect(route('routineClients.index'));
        }

        $routineClient = $this->routineClientRepository->update($request->all(), $id);

        Flash::success('Routine Client updated successfully.');

        return redirect(route('routineClients.index'));
    }

    /**
     * Remove the specified RoutineClientModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $routineClient = $this->routineClientRepository->find($id);

        if (empty($routineClient)) {
            Flash::error('Routine Client not found');

            return redirect(route('routineClients.index'));
        }

        $this->routineClientRepository->delete($id);

        Flash::success('Routine Client deleted successfully.');

        return redirect(route('routineClients.index'));
    }
}
