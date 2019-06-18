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
        $key->label = 'Duración Aproximada';
        $key->key = 'duration';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'number';
        $key->save();



        $key = new \App\Models\KeyModel();
        $key->label = 'Dificultad';
        $key->key = 'difficulty';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Beneficio';
        $key->key = 'benefit';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'URL Imagen';
        $key->key = 'image';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'image';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Calorias';
        $key->key = 'calories';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'number';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Kg Fuerza';
        $key->key = 'force';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Color App';
        $key->key = 'color';
        $key->model = '\App\Models\ClassModel';
        $key->reference = 'classes';
        $key->type = 'color';
        $key->save();


    }
}
