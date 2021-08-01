<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * php artisan make:seeder SettingDatabaseSeeder

     */

    public function run()
    {
        Setting::setmany([
            'default_local'=>'ar',
            'default_timezone'=>'africa/cairo',
            'reviews_enabled'=>true,
            'auto_approve_enabled'=>true,
            'supported_currency'=>['USD','LE','SAR'],
            'default_currency'=>'USD',
            'store_email'=>'admin@sotre.com',
            'search_engine'=>'mysql',
            'local_shipping_cost'=>'0',
            'outer_shipping_cost'=>'0',
            'free_shipping_cost'=>'0',
            'translatable'=>[
                'storename'=>'Eslam Store',
                'free_shipping_label'=>'free shipping',
                'local_label'=>'local shipping',
                'outer_label'=>'outer shipping',
            ]


        ]);
    }
}
