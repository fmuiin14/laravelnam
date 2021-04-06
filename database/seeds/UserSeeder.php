<?php

use App\User;
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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@fmuiin.com',
            'password' => bcrypt('123456'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Finance',
            'email' => 'finance@fmuiin.com',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole('finance');
    }
}
