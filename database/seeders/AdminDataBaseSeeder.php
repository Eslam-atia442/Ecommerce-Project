<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Superadmin',
            'email'=>'Superadmin@admin.com',
            'password'=>bcrypt('123456789'),
            'role_id'=>('1'),
        ]);

        Admin::create([
            'name'=>'mohsen',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('123456789'),
            'role_id'=>('2'),
        ]);

    }
}
