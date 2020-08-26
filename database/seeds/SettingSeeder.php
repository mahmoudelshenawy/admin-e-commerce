<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'sitename_ar' => 'تسويق الكترونى',
            'sitename_en' => 'online shopping',
            'main_lang' => 'ar'
        ]);
    }
}
