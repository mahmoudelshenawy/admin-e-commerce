<?php

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
        \App\Admin::create([
            'name' => 'superAdmin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('1234567')
        ]);
    }
}
