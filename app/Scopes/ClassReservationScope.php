<?php


namespace App\Scopes;


use App\Models\ClassScheduleModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ClassReservationScope implements Scope {

    public function apply( Builder $builder, Model $model ) {
        if ( Auth::check() ) {
            $user = Auth::user();
            if ($user->role_id != 1) {
                $classes = ClassScheduleModel::all()->pluck('id');
                $builder->where('class_schedule_id', 'in', $classes);
            }
        }
    }

}