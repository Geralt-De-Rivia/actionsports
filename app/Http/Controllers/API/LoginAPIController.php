<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateClientAPIRequest;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ClientController
 * @package App\Http\Controllers\API
 */
class LoginAPIController extends AppBaseController
{
    /** @var  ClientRepository */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }


    /**
     * @param CreateClientAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/clients",
     *      summary="Login a Client",
     *      tags={"Client"},
     *      description="Store Client",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Client that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Client")
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
     *                  ref="#/definitions/Client"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(Request $request)
    {
        try {
            $input = $request->all();

            $client = $this->clientRepository->login($input['membership_number'], $input['code']);

            return $this->sendResponse($client->toArray(), 'Login successfully');

        } catch (\Exception $exception) {

            return $this->sendError($exception->getMessage(), 200);
        }
    }

}
