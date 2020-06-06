<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Complitedquestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complitedquestion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('complitedpass_id');
            $table->integer('question_id');
            $table->integer('answer_id');
            $table->integer('student_id');
            $table->tinyInteger('correct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complitedquestion');
    }
}
