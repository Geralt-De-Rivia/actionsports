<?php

use Illuminate\Database\Seeder;

class ClassKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key = new \App\Models\KeysModel();
        $key->label = 'Kg Fuerza';
        $key->model = '\App\Models\ClassModel';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeysModel();
        $key->label = 'Calorias';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Duración Aproximada';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Beneficio';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Material';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Dificultad';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Color';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'color';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Imagen 1';
        $key->model = '\App\Models\ActivityModel';
        $key->type = 'image';
        $key->save();
    }
}
