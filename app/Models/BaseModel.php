<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{

    public static function getPropertyHtml($className)
    {
        $keys = KeysModel::where('model', '=', $className)->get();
        $html = '';
        foreach ($keys as $key){
            switch ($key->type){
                case 'text':
                    $html.= BaseModel::getInputText($key->id, $key->label);
                    break;
            }
        }

    }

    public static function getInputText($id, $label)
    {
        return '<div class="col-md-12 pl-1">
                      <div class="form-group">
                        <label for="$id">$label</label>
                        <input type="text" class="form-control" placeholder="$label" name="$id">
                      </div>
                    </div>';
    }
}