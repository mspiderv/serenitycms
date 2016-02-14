<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTypeVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->unsigned();
            $table->integer('content_type_id')->unsigned();
            $table->string('field', 255);
            $table->string('variable', 255);
            $table->string('data_type', 255);
            $table->string('constraint', 255);
            $table->boolean('nullable');
            $table->boolean('unsigned');

            $table->foreign('content_type_id')
                ->references('id')->on('content_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_type_variables');
    }
}
