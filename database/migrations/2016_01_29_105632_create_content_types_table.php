<?php

use Serenity\ContentType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->unsigned();
            $table->string('name', 255);
            $table->boolean('pageable');
            $table->boolean('panelable');
            $table->string('page_template', 255)->nullable();
            $table->string('panel_template', 255)->nullable();
            $table->string('page_class', 255)->nullable();
            $table->string('panel_class', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (ContentType::all() as $contentType)
        {
            $contentType->delete();
        }

        Schema::drop('content_types');
    }
}
