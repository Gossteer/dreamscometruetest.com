<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsForPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_for_passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('Childrens')->default(0);
            $table->tinyInteger('Gorwns')->default(0);
            $table->integer('Prepayment')->default(0);
            $table->boolean('LogicalDelete')->default(0);
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
        Schema::dropIfExists('contracts_for_passengers');
    }
}
