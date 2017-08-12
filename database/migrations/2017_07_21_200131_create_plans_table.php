<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('grade');
            $table->date('date_from');
            $table->date('date_to');
            $table->text('standards')->nullable();
            $table->text('expectations')->nullable();
            $table->text('essential_questions')->nullable();
            $table->text('objectives')->nullable();
            $table->text('activities')->nullable();
            $table->text('evaluations')->nullable();
            $table->text('daily_plan')->nullable();
            $table->text('observations')->nullable();
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
