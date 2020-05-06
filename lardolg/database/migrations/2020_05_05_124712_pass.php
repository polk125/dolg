<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('lesson_id');
            $table->tinyInteger('teacher_id');
            $table->tinyInteger('class_id');
            $table->text('value');
            $table->text('why')->default('');
            $table->tinyInteger('tire');
            $table->tinyInteger('test_id');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass');
    }
}
