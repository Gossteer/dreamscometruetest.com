<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedAdditionalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_additional_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('passengers_id')->unsigned();
            $table->bigInteger('additional_service_id');
            $table->timestamps();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('passengers_id')->references('id')
                ->on('passengers');
            $table->foreign('additional_service_id')->references('id')
                ->on('additional_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_additional_services');
    }
}
