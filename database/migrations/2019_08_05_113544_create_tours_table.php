<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('albums_id')->unsigned();
            $table->foreign('albums_id')->references('id')
                ->on('albums')->onDelete('SET NULL');
            $table->bigInteger('type_tours_id')->unsigned();
            $table->foreign('type_tours_id')->references('id')
                ->on('type_tours')->onDelete('SET NULL');
            $table->bigInteger('routes_id')->unsigned()->nullable();
            $table->foreign('routes_id')->references('id')
                ->on('routes');
            $table->bigInteger('buses_id')->unsigned()->nullable();
            $table->foreign('buses_id')->references('id')
                ->on('buses');
            $table->boolean('ZGP')->default(0);
            $table->boolean('PRF')->default(0);
            $table->string('Name_Tours', 191);
            $table->date('Start_Date_Tours');
            $table->date('End_Date_Tours')->nullable();
            $table->mediumInteger('Price');
            $table->string('Notification_OPDA',191)->nullable();
            $table->integer('Profit')->default(0);
            $table->integer('Expenses');
            $table->mediumInteger('Privilegens_Price');
            $table->mediumInteger('Amount_Place');
            $table->mediumInteger('Occupied_Place')->default(0);
            $table->tinyInteger('Confirmation_Tours')->default(0);
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
        Schema::dropIfExists('tours');
    }
}
