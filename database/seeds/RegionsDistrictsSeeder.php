<?php

use Illuminate\Database\Seeder;

class RegionsDistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Serenity\Region::class, 10)->create()->each(function($region) {
            $region->districts()->save(factory(Serenity\District::class)->make());
            $region->districts()->save(factory(Serenity\District::class)->make());
            $region->districts()->save(factory(Serenity\District::class)->make());
        });
    }
}
