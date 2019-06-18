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
        $start = $input['start'];
        $end = $input['end'];
        $service = new ClassesService();

        return Response::json($service->buildClasses($start, $end));
        //return $this->sendResponse($service->buildClasses($month, $year), 'Ok');
    }

    public function next()
    {
        $service = new ClassesService();
        return $this->sendResponse($service->nextClass(), 'Ok');
    }

    public function week()
    {
        $service = new ClassesService();
        return $this->sendResponse($service->classWeek(), 'Ok');
    }

}