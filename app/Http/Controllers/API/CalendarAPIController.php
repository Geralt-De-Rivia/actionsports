<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\AppBaseController;
use App\Util\ClassesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CalendarAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $input = $request->all();
        $month = $input['month'];
        $year = $input['year'];
        $service = new ClassesService();

       	return Response::json($service->buildClasses($month, $year));
        //return $this->sendResponse($service->buildClasses($month, $year), 'Ok');
    }

}