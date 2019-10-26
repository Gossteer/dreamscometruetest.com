<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tours_id')->unsigned();
            $table->string('Name', 191);
            $table->integer('Count')->default(1);
            $table->integer('Price')->nullable();
            $table->text('Description')->default('Подробности по телефону.');
            $table->timestamps();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('tours_id')->references('id')
                ->on('tours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_services');
    }
}
