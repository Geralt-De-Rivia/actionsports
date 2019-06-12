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
        $key = new \App\Models\KeyModel();
        $key->label = 'Kg Fuerza';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Calorias';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Duración Aproximada';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Beneficio';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Material';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Dificultad';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Color';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'color';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Imagen 1';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'image';
        $key->save();
    }
}
