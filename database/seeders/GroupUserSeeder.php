<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GroupUser;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GroupUser::create([

            'group' => 'ROOT',
            'description' => 'ROOT GROUP',
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        GroupUser::create([

            'group' => 'ADMIN',
            'description' => 'ADMIN GROUP',
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        GroupUser::create([

            'group' => 'END USER',
            'description' => 'END USER GROUP',
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);
    }
}
