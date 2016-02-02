<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('code', 255)->unique();
            $table->string('panel_template', 255)->nullable();
            $table->string('panel_class', 255)->nullable();

            $table->foreign('id')
                ->references('id')->on('contents')
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
        Schema::drop('panels');
    }
}
