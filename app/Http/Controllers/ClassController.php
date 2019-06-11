<?php

namespace App\Http\Controllers;

use App\DataTables\ClassDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Repositories\ClassRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ClassController extends AppBaseController
{
    /** @var  ClassRepository */
    private $classRepository;

    public function __construct(ClassRepository $classRepo)
    {
        $this->classRepository = $classRepo;
    }

    /**
     * Display a listing of the Class.
     *
     * @param ClassDataTable $classDataTable
     * @return Response
     */
    public function index(ClassDataTable $classDataTable)
    {
        return $classDataTable->render('classes.index');
    }

    /**
     * Show the form for creating a new Class.
     *
     * @return Response
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created Class in storage.
     *
     * @param CreateClassRequest $request
     *
     * @return Response
     */
    public function store(CreateClassRequest $request)
    {
        $input = $request->all();

        $class = $this->classRepository->create($input);

        Flash::success('Class saved successfully.');

        return redirect(route('classes.index'));
    }

    /**
     * Display the specified Class.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            Flash::error('Class not found');

            return redirect(route('classes.index'));
        }

        return view('classes.show')->with('class', $class);
    }

    /**
     * Show the form for editing the specified Class.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            Flash::error('Class not found');

            return redirect(route('classes.index'));
        }

        return view('classes.edit')->with('class', $class);
    }

    /**
     * Update the specified Class in storage.
     *
     * @param  int              $id
     * @param UpdateClassRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassRequest $request)
    {
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            Flash::error('Class not found');

            return redirect(route('classes.index'));
        }

        $class = $this->classRepository->update($request->all(), $id);

        Flash::success('Class updated successfully.');

        return redirect(route('classes.index'));
    }

    /**
     * Remove the specified Class from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            Flash::error('Class not found');

            return redirect(route('classes.index'));
        }

        $this->classRepository->delete($id);

        Flash::success('Class deleted successfully.');

        return redirect(route('classes.index'));
    }
}
