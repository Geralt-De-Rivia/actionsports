<?php

use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new \App\Models\ClientStatusModel();
        $status->name = 'Preinscrito';
        $status->save();

        $status = new \App\Models\ClientStatusModel();
        $status->name = 'Activo';
        $status->save();

        $status = new \App\Models\ClientStatusModel();
        $status->name = 'Suspendido';
        $status->save();

    }
}
