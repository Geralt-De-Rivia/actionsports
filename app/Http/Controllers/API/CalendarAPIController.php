<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\AppBaseController;
use App\Util\ClassesService;
use Illuminate\Http\Request;

class CalendarAPIController extends AppBaseController
{

    public function index(Request $request)
    {
        $input = $request->all();
        $month = $input['month'];
        $year = $input['year'];
        $service = new ClassesService();
        return $this->sendResponse($service->buildClasses($month, $year), 'Ok');
    }

}