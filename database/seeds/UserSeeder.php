<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\UserModel();
        $user->name = 'Administrador';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('123456');
        $user->role_id = 1;
        $user->status = true;
        $user->save();
    }
}
