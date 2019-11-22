<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->bigInteger('tours_id')->unsigned();
            $table->bigInteger('passengers_id')->unsigned();
            $table->mediumInteger('Amount of children')->nullable();
            $table->integer('Sum');
            $table->boolean('Paid')->default(0);
            $table->timestamps();

            $table->foreign('passengers_id')->references('id')
                ->on('passengers')->onDelete('CASCADE');
            $table->foreign('employee_id')->references('id')
                ->on('employees')->onDelete('SET NULL');
            $table->foreign('tours_id')->references('id')
                ->on('tours')->onDelete('CASCADE');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depts');
    }
}
