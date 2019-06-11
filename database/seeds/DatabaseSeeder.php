<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(ActivityKeysSeeder::class);
        $this->call(ClassTypeSeeder::class);
        $this->call(MachineKeysSeeder::class);
        $this->call(NewKeysSeeder::class);
        $this->call(ClassKeysSeeder::class);
        $this->call(UserSeeder::class);

    }
}
