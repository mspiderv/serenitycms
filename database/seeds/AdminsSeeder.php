<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed fake users
        factory(Serenity\Admin::class, 4)->create();

        // Seed real users
        Serenity\Admin::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
        ]);
    }
}
