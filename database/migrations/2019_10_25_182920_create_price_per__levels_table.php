<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricePerLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_per_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tour_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->integer('Price');
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('tour_id')->references('id')
                ->on('tours');
            $table->foreign('level_id')->references('id')
                ->on('levels');
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
        Schema::dropIfExists('price__per__levels');
    }
}
