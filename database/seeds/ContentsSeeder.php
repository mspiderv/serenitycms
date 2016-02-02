<?php

use Illuminate\Database\Seeder;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = 8;
        $contentTypes = \Serenity\ContentType::all()->count();

        for ($i = 0; $i < $contents; $i++)
        {
            $content = factory(Serenity\Content::class)->create([
                'content_type_id' => rand(1, $contentTypes)
            ]);

            if (rand(0, 1))
                factory(Serenity\Page::class)->create([
                    'id' => $content->getKey()
                ]);

            if (rand(0, 1))
                factory(Serenity\Panel::class)->create([
                    'id' => $content->getKey()
                ]);
        }
    }
}
