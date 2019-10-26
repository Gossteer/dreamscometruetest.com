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
            $table->smallInteger('Passport_Series')->nullable();
            $table->mediumInteger('Passport_Id')->nullable();
            $table->string('Description', 191)->default('Лучший в своем деле!');
            $table->smallInteger('Occupied_Place_Bus')->default(0);
            $table->string('Phone_Number', 191)->unique();
            $table->string('Contract_Employee', 191)->nullable();
            $table->date('Date_Driver_License')->nullable();
            $table->boolean('Set_Permission')->default(0);
            $table->integer('Man_brought')->default(0);
            $table->integer('Joint excursions')->default(0);
            $table->smallInteger('Driving_License_Series')->nullable();
            $table->mediumInteger('Driver_License_Id')->nullable();
            $table->bigInteger('jobs_id')->unsigned()->nullable();
            $table->bigInteger('Work_Schedule_id')->unsigned()->nullable();
            $table->bigInteger('driving_license_categories_id')->unsigned()->nullable();
            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('jobs_id')->references('id')
                ->on('jobs');
            $table->foreign('level_id')->references('id')
                ->on('levels');
            $table->foreign('Work_Schedule_id')->references('id')
                ->on('Work_Schedule')->onDelete('SET NULL');
            $table->foreign('driving_license_categories_id')->references('id')
                ->on('driving_license_categories')->onDelete('SET NULL');
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
