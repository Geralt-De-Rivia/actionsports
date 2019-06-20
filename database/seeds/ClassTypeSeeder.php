<?php

use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classType = new \App\Models\ClassTypeModel();
        $classType->name = 'Fitness';
        $classType->save();

        $classType = new \App\Models\ClassTypeModel();
        $classType->name = 'Pileta';
        $classType->save();
    }
}
