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
            $table->foreign('tours_id')->references('id')
                ->on('tours')->onDelete('CASCADE');
            $table->bigInteger('customers_id')->unsigned();
            $table->foreign('customers_id')->references('id')
                ->on('customers')->onDelete('CASCADE');
            $table->boolean('Preferential_Terms')->default(0);
            $table->boolean('Accompanying')->default(0);
            $table->tinyInteger('Amount_Children')->default(0);
            $table->tinyInteger('Presence')->default(0);
            $table->smallInteger('Occupied_Place_Bus')->nullable();
            $table->string('Document')->nullable();
            $table->boolean('Paid')->default(0);
            $table->tinyInteger('Stars')->nullable();
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
        Schema::dropIfExists('passengers');
    }
}
