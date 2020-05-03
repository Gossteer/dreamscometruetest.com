<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeTourManiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_tour_manies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type_tours_id')->unsigned();
            $table->bigInteger('tour_id')->unsigned();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('SET NULL');
            $table->foreign('type_tours_id')->references('id')
            ->on('type_tours')->onDelete('SET NULL');
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
        Schema::dropIfExists('type_tour_manies');
    }
}
