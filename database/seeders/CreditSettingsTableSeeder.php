<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("credit_settings")->insert([
            'sms_send' =>  1,
            'sms_validate' =>  1,
            'email_send' =>  1,
            'email_validate' =>  1,
        ]);
    }
}
