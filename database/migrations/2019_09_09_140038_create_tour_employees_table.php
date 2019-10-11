<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('Salary')->default(0);
            $table->bigInteger('tour_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('tour_id')->references('id')
                ->on('tours');
            $table->foreign('employee_id')->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_employees');
    }
}
