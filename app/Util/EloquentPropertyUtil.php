<?php


namespace App\Util;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EloquentPropertyUtil
{
    public static function build(Model $model)
    {
        $properties = DB::table('properties')
            ->join('keys', 'keys.id', '=', 'properties.key_id')
            ->select('keys.label', 'keys.type', 'keys.key', 'properties.value')
            ->where('properties.model_id', '=', $model->id)
            ->where('keys.model', '=', '\\' . $model->getMorphClass())
            ->get();

        foreach ($properties as $property) {
            $model->{$property->key} = $property->value;
        }
        return $model;

    }

    public static function getProperty(Model $model, $property)
    {
        $properties = DB::table('properties')
            ->join('keys', 'keys.id', '=', 'properties.key_id')
            ->select('keys.label', 'keys.type', 'keys.key', 'properties.value')
            ->where('properties.model_id', '=', $model->id)
            ->where('keys.model', '=', '\\' . $model->getMorphClass())
            ->where('keys.key', '=', $property)
            ->get();

        return $properties->first();

    }

    public static function getPropertyValue(Model $model, $property)
    {
        $properties = DB::table('properties')
            ->join('keys', 'keys.id', '=', 'properties.key_id')
            ->select('keys.label', 'keys.type', 'keys.key', 'properties.value')
            ->where('properties.model_id', '=', $model->id)
            ->where('keys.model', '=', '\\' . $model->getMorphClass())
            ->where('keys.key', '=', $property)
            ->get();

        if(!empty($properties->first())){
            return $properties->first()->value;
        }else{
            return null;
        }
    }

}