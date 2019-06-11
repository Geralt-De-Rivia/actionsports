<?php

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\Models\RolModel();
        $rol->name = 'Administrador';
        $rol->description = 'Administrador del sistema';
        $rol->save();

        $rol = new \App\Models\RolModel();
        $rol->name = 'Instructor';
        $rol->description = 'Instructor del gimnasio';
        $rol->save();

    }
}
