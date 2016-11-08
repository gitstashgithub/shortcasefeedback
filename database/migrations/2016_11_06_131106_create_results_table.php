<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('results', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('assessment_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->integer('technique_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('technique_id')->references('id')->on('techniques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('results');
    }
}
