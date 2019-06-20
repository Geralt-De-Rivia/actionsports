<?php

use Illuminate\Database\Seeder;

class ActivityKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key = new \App\Models\KeyModel();
        $key->label = 'Cantidad';
        $key->key = 'quantity';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Repeticiones';
        $key->key = 'repetitions';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Kg / Fuerza ';
        $key->key = 'force';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Calorias';
        $key->key = 'calories';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Duración Aproximada (min)';
        $key->key = 'duration';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Dificultad';
        $key->key = 'difficulty';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'number';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Url Imagen';
        $key->key = 'image';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'image';
        $key->save();
    }
}
