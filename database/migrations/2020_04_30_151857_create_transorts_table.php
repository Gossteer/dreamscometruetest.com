<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buses_id')->unsigned();
            $table->bigInteger('tour_id')->unsigned();

            $table->foreign('buses_id')->references('id')
            ->on('buses');
            $table->foreign('tour_id')->references('id')
            ->on('tours');
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
        Schema::dropIfExists('transorts');
    }
}
