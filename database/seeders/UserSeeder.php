<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([

            'name' => 'Root',
            'email' => 'root@gmail.com',
            'level' => 1,
            'password' => Hash::make('123'),
            //'password' => bcrypt('123456'),
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        User::create([

            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'level' => 2,
            'password' => Hash::make('123'),
            //'password' => bcrypt('123456'),
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        User::create([

            'name' => 'end user',
            'email' => 'user@gmail.com',
            'level' => 3,
            'password' => Hash::make('123'),
            //'password' => bcrypt('123456'),
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);
    }
}
