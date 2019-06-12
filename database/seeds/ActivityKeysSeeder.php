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
        $key->label = 'Cantidad de ejercicio';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Kg Fuerza';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Calorias';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Duración Aproximada';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Dificultad';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Imagen 1';
        $key->model = '\App\Models\ActivityModel';
        $key->reference = 'activities';
        $key->type = 'image';
        $key->save();
    }
}
