<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('Name', 191);
            $table->string('Surname', 191);
            $table->string('Middle_Name', 191)->nullable();
            $table->date('Byrthday', 191)->nullable();
            $table->string('Description', 191)->default('Лучший в своем деле!');
            $table->string('Phone_Number', 191)->unique();
            $table->string('Photo', 191)->nullable();
            $table->string('Contract_Employee', 191)->nullable();
            $table->boolean('Set_Permission')->default(0);
            $table->integer('Man_brought')->default(0);
            $table->integer('Joint_excursions')->default(0);
            $table->smallInteger('Level')->default(0);
            $table->bigInteger('jobs_id')->unsigned()->nullable();
            $table->bigInteger('Work_Schedule_id')->unsigned()->nullable();
            $table->bigInteger('passport_date_id')->unsigned()->nullable();
            $table->bigInteger('drivers_lisense_id')->unsigned()->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('jobs_id')->references('id')
                ->on('jobs');
            $table->foreign('Passport_date_id')->references('id')
                ->on('passport_date');
            $table->foreign('Drivers_lisense_id')->references('id')
                ->on('drivers_lisense');
            $table->foreign('Work_Schedule_id')->references('id')
                ->on('Work_Schedule')->onDelete('SET NULL');
            $table->foreign('users_id')->references('id')
                ->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
