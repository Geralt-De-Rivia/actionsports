<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNewAPIRequest;
use App\Http\Requests\API\UpdateNewAPIRequest;
use App\Models\NewModel;
use App\Repositories\NewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NewController
 * @package App\Http\Controllers\API
 */

class NewAPIController extends AppBaseController
{
    /** @var  NewRepository */
    private $newRepository;

    public function __construct(NewRepository $newRepo)
    {
        $this->newRepository = $newRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/news",
     *      summary="Get a listing of the News.",
     *      tags={"New"},
     *      description="Get all News",
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
     *                  @SWG\Items(ref="#/definitions/New")
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
        $news = $this->newRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($news->toArray(), 'News retrieved successfully');
    }

    /**
     * @param CreateNewAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/news",
     *      summary="Store a newly created New in storage",
     *      tags={"New"},
     *      description="Store New",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="New that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/New")
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
     *                  ref="#/definitions/New"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNewAPIRequest $request)
    {
        $input = $request->all();

        $new = $this->newRepository->create($input);

        return $this->sendResponse($new->toArray(), 'New saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/news/{id}",
     *      summary="Display the specified New",
     *      tags={"New"},
     *      description="Get New",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of New",
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
     *                  ref="#/definitions/New"
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
        /** @var New $new */
        $new = $this->newRepository->find($id);

        if (empty($new)) {
            return $this->sendError('New not found');
        }

        return $this->sendResponse($new->toArray(), 'New retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNewAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/news/{id}",
     *      summary="Update the specified New in storage",
     *      tags={"New"},
     *      description="Update New",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of New",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="New that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/New")
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
     *                  ref="#/definitions/New"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNewAPIRequest $request)
    {
        $input = $request->all();

        /** @var New $new */
        $new = $this->newRepository->find($id);

        if (empty($new)) {
            return $this->sendError('New not found');
        }

        $new = $this->newRepository->update($input, $id);

        return $this->sendResponse($new->toArray(), 'New updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/news/{id}",
     *      summary="Remove the specified New from storage",
     *      tags={"New"},
     *      description="Delete New",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of New",
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
        /** @var New $new */
        $new = $this->newRepository->find($id);

        if (empty($new)) {
            return $this->sendError('New not found');
        }

        $new->delete();

        return $this->sendResponse($id, 'New deleted successfully');
    }
}
