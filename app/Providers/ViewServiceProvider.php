<?php


namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'machines.create',
                'machines.edit',
                'classes.create',
                'classes.edit',
                'activities.create',
                'activities.edit'
            ],
            'App\Http\ViewComposers\FieldComposer'
        );
    }
}