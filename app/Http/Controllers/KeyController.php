<?php

namespace App\Http\Controllers;

use App\DataTables\KeyDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Repositories\KeyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class KeyController extends AppBaseController
{
    /** @var  KeyRepository */
    private $keyRepository;

    public function __construct(KeyRepository $keyRepo)
    {
        $this->keyRepository = $keyRepo;
    }

    /**
     * Display a listing of the Key.
     *
     * @param KeyDataTable $keyDataTable
     * @return Response
     */
    public function index(KeyDataTable $keyDataTable)
    {
        return $keyDataTable->render('keys.index');
    }

    /**
     * Show the form for creating a new Key.
     *
     * @return Response
     */
    public function create()
    {
        return view('keys.create');
    }

    /**
     * Store a newly created Key in storage.
     *
     * @param CreateKeyRequest $request
     *
     * @return Response
     */
    public function store(CreateKeyRequest $request)
    {
        $input = $request->all();

        $key = $this->keyRepository->create($input);

        Flash::success('Key saved successfully.');

        return redirect(route('keys.index'));
    }

    /**
     * Display the specified Key.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $key = $this->keyRepository->find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        return view('keys.show')->with('key', $key);
    }

    /**
     * Show the form for editing the specified Key.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $key = $this->keyRepository->find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        return view('keys.edit')->with('key', $key);
    }

    /**
     * Update the specified Key in storage.
     *
     * @param  int              $id
     * @param UpdateKeyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKeyRequest $request)
    {
        $key = $this->keyRepository->find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        $key = $this->keyRepository->update($request->all(), $id);

        Flash::success('Key updated successfully.');

        return redirect(route('keys.index'));
    }

    /**
     * Remove the specified Key from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $key = $this->keyRepository->find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        $this->keyRepository->delete($id);

        Flash::success('Key deleted successfully.');

        return redirect(route('keys.index'));
    }
}
