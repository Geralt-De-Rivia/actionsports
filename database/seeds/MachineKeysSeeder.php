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
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Imagen';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'image';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Link';
        $key->model = '\App\Models\MachineModel';
        $key->reference = 'machines';
        $key->type = 'link';
        $key->save();


    }
}
