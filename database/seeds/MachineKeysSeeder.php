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
        $key = new \App\Models\KeysModel();
        $key->label = 'Descripcion';
        $key->model = '\App\Models\MachineModel';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeysModel();
        $key->label = 'Imagen';
        $key->model = '\App\Models\MachineModel';
        $key->type = 'image';
        $key->save();

        $key = new \App\Models\KeysModel();
        $key->label = 'Link';
        $key->model = '\App\Models\MachineModel';
        $key->type = 'link';
        $key->save();


    }
}
