<?php

namespace App\Http\Controllers;

use App\DataTables\ClassTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateClassTypeRequest;
use App\Http\Requests\UpdateClassTypeRequest;
use App\Repositories\ClassTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ClassTypeController extends AppBaseController
{
    /** @var  ClassTypeRepository */
    private $classTypeRepository;

    public function __construct(ClassTypeRepository $classTypeRepo)
    {
        $this->classTypeRepository = $classTypeRepo;
    }

    /**
     * Display a listing of the ClassType.
     *
     * @param ClassTypeDataTable $classTypeDataTable
     * @return Response
     */
    public function index(ClassTypeDataTable $classTypeDataTable)
    {
        return $classTypeDataTable->render('class_types.index');
    }

    /**
     * Show the form for creating a new ClassType.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_types.create');
    }

    /**
     * Store a newly created ClassType in storage.
     *
     * @param CreateClassTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateClassTypeRequest $request)
    {
        $input = $request->all();

        $classType = $this->classTypeRepository->create($input);

        Flash::success('Tipo de Clase Guardada Satisfactoriamente.');

        return redirect(route('classTypes.index'));
    }

    /**
     * Display the specified ClassType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            Flash::error('Class Type not found');

            return redirect(route('classTypes.index'));
        }

        return view('class_types.show')->with('classType', $classType);
    }

    /**
     * Show the form for editing the specified ClassType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            Flash::error('Class Type not found');

            return redirect(route('classTypes.index'));
        }

        return view('class_types.edit')->with('classType', $classType);
    }

    /**
     * Update the specified ClassType in storage.
     *
     * @param  int              $id
     * @param UpdateClassTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassTypeRequest $request)
    {
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            Flash::error('Class Type not found');

            return redirect(route('classTypes.index'));
        }

        $classType = $this->classTypeRepository->update($request->all(), $id);

        Flash::success('Class Type updated successfully.');

        return redirect(route('classTypes.index'));
    }

    /**
     * Remove the specified ClassType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classType = $this->classTypeRepository->find($id);

        if (empty($classType)) {
            Flash::error('Class Type not found');

            return redirect(route('classTypes.index'));
        }

        $this->classTypeRepository->delete($id);

        Flash::success('Class Type deleted successfully.');

        return redirect(route('classTypes.index'));
    }
}
