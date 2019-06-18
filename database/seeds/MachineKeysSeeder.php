<?php

use Illuminate\Database\Seeder;

class MachineKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key = new \App\Models\KeyModel();
        $key->label = 'Descripcion';
        $key->key = 'description';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'textarea';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Url Imagén';
        $key->key = 'imagen';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'image';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Link';
        $key->key = 'link';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'link';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Item 1';
        $key->key = 'item1';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Item 2';
        $key->key = 'item2';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'text';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Item 3';
        $key->key = 'item3';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'text';
        $key->save();


    }
}
