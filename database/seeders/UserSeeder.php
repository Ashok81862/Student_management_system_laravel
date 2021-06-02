<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name'  =>  'Admin',
            'email'   =>    'admin@admin.com',
            'password'  =>  bcrypt('password'),
            'role'  =>  'Admin'
        ]);

        User::create([
            'name'  =>  'Student',
            'email'   =>    'student@admin.com',
            'password'  =>  bcrypt('password'),
            'role'  =>  'Student'
        ]);

        User::create([
            'name'  =>  'Teacher',
            'email'   =>    'teacher@admin.com',
            'password'  =>  bcrypt('password'),
            'role'  =>  'Teacher'
        ]);

        User::create([
            'name'  =>  'Parent',
            'email'   =>    'parent@admin.com',
            'password'  =>  bcrypt('password'),
            'role'  =>  'Parent'
        ]);
    }
}
