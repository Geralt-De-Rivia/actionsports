<?php

use Illuminate\Database\Seeder;

class NewKeysSeeder extends Seeder
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
        $key->model = '\App\Models\NewModel';
        $key->reference = 'news';
        $key->type = 'text';
        $key->save();


        $key = new \App\Models\KeyModel();
        $key->label = 'Imagen';
        $key->key = 'image';
        $key->model = '\App\Models\NewModel';
        $key->reference = 'news';
        $key->type = 'image';
        $key->save();

        $key = new \App\Models\KeyModel();
        $key->label = 'Link';
        $key->key = 'link';
        $key->model = '\App\Models\NewModel';
        $key->reference = 'news';
        $key->type = 'link';
        $key->save();


    }
}
