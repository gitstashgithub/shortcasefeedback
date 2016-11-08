<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('assessments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_id')->unsigned();
            $table->string('email')->unique();
            $table->integer('time');
            $table->timestamps();

            $table->foreign('examination_id')->references('id')->on('examinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('assessments');
    }
}
