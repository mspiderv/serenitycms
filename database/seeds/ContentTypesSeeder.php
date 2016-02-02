<?php

use Illuminate\Database\Seeder;

class ContentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contentTypes = 3;
        $contentTypeRelations = 3;
        $contentTypeVariables = 3 * $contentTypes;

        factory(Serenity\ContentType::class, $contentTypes)->create();

        for ($i = 0; $i < $contentTypeRelations; $i++)
            factory(Serenity\ContentTypeRelation::class)->create([
                'left_id' => rand(1, $contentTypes),
                'right_id' => rand(1, $contentTypes),
            ]);

        for ($i = 0; $i < $contentTypeVariables; $i++)
            factory(Serenity\ContentTypeVariable::class)->create([
                'content_type_id' => rand(1, $contentTypes)
            ]);
    }
}
