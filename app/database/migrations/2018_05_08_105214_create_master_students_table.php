<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('pass');
            $table->string('class');
            $table->string('username');
            $table->text('coaching');
            $table->integer('pscore');
            $table->integer('cscore');
            $table->integer('mscore');
            $table->integer('bscore');
            $table->string('phone');
            $table->string('net');
            $table->integer('attempted');
            $table->integer('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_students');
    }
}
