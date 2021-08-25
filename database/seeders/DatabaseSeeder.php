<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        $this->call(SettingDatabaseSeeder::class);
        $this->call(RoleDataBaseSeeder::class);
        $this->call(AdminDataBaseSeeder::class);
//        $this->call(ProductDatabaseSeeder::class);


    }
}
