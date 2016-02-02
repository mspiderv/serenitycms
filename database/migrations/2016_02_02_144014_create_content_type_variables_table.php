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
            $table->string('variable', 255);
            // TODO: field (vizualny prvok na upravu hodnoty premennej) - bud to bdue foreign key na nejaku tabulku, alebo nieco ine (nazov triedy ?)
            // TODO: data type - datovy typ na ulozenie hodnoty premennej v DB

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
