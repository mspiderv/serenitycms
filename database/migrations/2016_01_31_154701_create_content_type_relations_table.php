<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTypeRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_type_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('left_id')->unsigned();
            $table->integer('right_id')->unsigned();
            $table->string('left_variable', 255)->nullable();
            $table->string('right_variable', 255)->nullable();
            $table->enum('relation_type', ['oneToOne', 'oneToMany', 'manyToMany']);

            $table->foreign('left_id')
                ->references('id')->on('content_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('right_id')
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
        Schema::drop('content_type_relations');
    }
}
