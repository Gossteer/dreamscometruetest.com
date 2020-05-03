<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('Map', 191);
            $table->string('Itinerary', 191);
            $table->bigInteger('tour_id')->unsigned()->nullable();
            $table->string('Distination_From_Initial_Pop', 191);
            $table->time('Time_Sending_From_Initial_Pop');
            $table->string('Distination_From_End_Point', 191);
            $table->time('Time_Sending_From_End_Point');
            $table->string('Name_Car_Dorough_Dorog_Report_Transportation', 191);

            $table->foreign('tour_id')->references('id')
            ->on('tours');
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
        Schema::dropIfExists('routes');
    }
}
