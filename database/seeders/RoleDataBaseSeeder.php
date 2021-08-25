<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'SuperAdmin',
            'permissions'=>'["users","options","brands","categories","tags","products"]',
        ]);

        Role::create([
            'name'=>'Admin',
            'permissions'=>'["products"]',
        ]);

    }
}
