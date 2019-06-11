<?php


namespace App\Http\ViewComposers;


use App\Models\KeysModel;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class FieldComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $name = $this->normalize($view->getName());

        $keys = KeysModel::where('reference','=',$name)->get();

        $view->with('extraFields', $keys);
    }

    private function normalize($name){
        $name = str_replace(".create","", $name);
        $name = str_replace(".edit","", $name);
        return $name;
    }
}