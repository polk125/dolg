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
            $table->textInteger('complitedpass_id');
            $table->textInteger('question_id');
            $table->textInteger('answer_id');
            $table->textInteger('student_id');
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
