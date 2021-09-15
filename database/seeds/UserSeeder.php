<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'fullname' => 'App locum',
                'email' => 'applocumadmin@yopmail.com',
                'password' => Hash::make('Password@123'),
                'role' => 'super admin'
            ],
            [
                'fullname' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin'
            ],
            [
                'fullname' => 'test user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('User@123'),
                'role' => 'user'
            ]
        ]);
    }
}
