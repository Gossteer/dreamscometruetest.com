<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('tours_id')->unsigned();
            $table->bigInteger('customers_id')->unsigned();
            $table->bigInteger('contracts_for_passengers_id')->unsigned()->nullable();
            $table->bigInteger('stock_id')->unsigned()->nullable();
            $table->boolean('Preferential_Terms')->default(0);
            $table->boolean('Accompanying')->default(0);
            $table->mediumInteger('Free_Children')->default(0);
            $table->tinyInteger('Amount_Children')->default(0);
            $table->tinyInteger('Assessment')->default(0);
            $table->tinyInteger('Presence')->default(0);
            $table->smallInteger('Occupied_Place_Bus')->nullable();
            $table->boolean('Paid')->default(0);
            $table->tinyInteger('Stars')->nullable();
            $table->integer('Final_Price')->default(0);
            $table->boolean('Payment_method');
            $table->string('Comment', 191)->default('Отсутствует');
            $table->boolean('LogicalDelete')->default(0);


            $table->foreign('tours_id')->references('id')
                ->on('tours')->onDelete('CASCADE');
            $table->foreign('customers_id')->references('id')
                ->on('customers')->onDelete('CASCADE');
            $table->foreign('contracts_for_passengers_id')
                ->references('id')->on('contracts_for_passengers')->onDelete('SET NULL');;
            $table->foreign('stock_id')->references('id')
                ->on('stocks')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
