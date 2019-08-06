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
            $table->string('Phone_Number', 191)->unique();
            $table->string('Contract_Employee', 191)->nullable();
            $table->date('Date_Driver_License')->nullable();
            $table->smallInteger('Driving_License_Series')->nullable();
            $table->mediumInteger('Driver_License_Id')->nullable();
            $table->bigInteger('jobs_id')->unsigned()->nullable();
            $table->foreign('jobs_id')->references('id')
                ->on('jobs')->onDelete('SET NULL');
            $table->bigInteger('Work_Schedule_id')->unsigned()->nullable();
            $table->foreign('Work_Schedule_id')->references('id')
                ->on('Work_Schedule')->onDelete('SET NULL');
            $table->bigInteger('driving_license_categories_id')->unsigned()->nullable();
            $table->foreign('driving_license_categories_id')->references('id')
                ->on('driving_license_categories')->onDelete('SET NULL');
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')
                ->on('users')->onDelete('SET NULL');
            $table->boolean('LogicalDelete')->default(0);
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
