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
            $table->string('Middle_Name', 191);
            $table->date('Byrthday', 191);
            $table->smallInteger('Passport_Series');
            $table->mediumInteger('Passport_Id');
            $table->string('Phone_Number', 191);
            $table->string('Contract_Employee', 191);
            $table->date('Date_Driver_License');
            $table->smallInteger('Driving_License_Series');
            $table->mediumInteger('Driver_License_Id');
            $table->bigInteger('jobs_id')->unsigned()->nullable();
            $table->foreign('jobs_id')->references('id')
                ->on('jobs')->onDelete('SET NULL');
            $table->bigInteger('Work_Schedule_id')->unsigned()->nullable();
            $table->foreign('Work_Schedule_id')->references('id')
                ->on('Work_Schedule')->onDelete('SET NULL');
            $table->bigInteger('driving__license__categories_id')->unsigned()->nullable();
            $table->foreign('driving__license__categories')->references('id')
                ->on('driving__license__categories')->onDelete('SET NULL');
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
