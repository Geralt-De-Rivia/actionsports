<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserScope implements Scope {

    public function apply( Builder $builder, Model $model ) {
        if ( Auth::check() ) {
            $user = Auth::user();
            if ($user->role_id != 1) {
                $builder->where('id', '=', $user->id);
            }
        }
    }

}