<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navigation;

class SysMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Navigation::create([

            'name' => 'Dashboard',
            'uri' => 'dashboard',
            'route' => 'dashboard',
            'menu_allowed' => '+1+2+3+',
            'parent_id' => 0,
            'group' => 'MAIN',
            'icon' => "'fas fa-home'",
            'sequence' => 1,
            'is_visible' => -1,
            'is_visible_user_right' => -1,
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        Navigation::create([

            'name' => 'System',
            'uri' => '#',
            'route' => '#',
            'menu_allowed' => '+1+2+',
            'parent_id' => 0,
            'group' => 'MAIN',
            'icon' => "'fas fa-wrench'",
            'sequence' => 1000,
            'is_visible' => -1,
            'is_visible_user_right' => -1,
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        Navigation::create([

            'name' => 'Group',
            'uri' => 'backend/group-user',
            'route' => 'group-user.index',
            'menu_allowed' => '+1+2+',
            'parent_id' => 2,
            'group' => 'MAIN',
            'icon' => '',
            'sequence' => 10001,
            'is_visible' => -1,
            'is_visible_user_right' => -1,
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);

        Navigation::create([

            'name' => 'User',
            'uri' => 'backend/user',
            'route' => 'user.index',
            'menu_allowed' => '+1+2+',
            'parent_id' => 2,
            'group' => 'MAIN',
            'icon' => '',
            'sequence' => 10002,
            'is_visible' => -1,
            'is_visible_user_right' => -1,
            'created_by' => 'ROOT',
            'updated_by' => 'ROOT',

        ]);
    }
}
