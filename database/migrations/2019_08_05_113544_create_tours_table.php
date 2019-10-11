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
            $table->bigInteger('albums_id')->unsigned()->nullable();
            $table->bigInteger('type_tours_id')->unsigned();
            $table->bigInteger('routes_id')->unsigned()->nullable();
            $table->bigInteger('buses_id')->unsigned()->nullable();
            $table->string('Duration', 191)->default('Подробности по телефону.');
            $table->boolean('Popular')->default(0);
            $table->boolean('ZGP')->default(0);
            $table->boolean('PRF')->default(0);
            $table->string('Name_Tours', 191);
            $table->text('Description')->default('Подробности по телефону.');;
            $table->date('Start_Date_Tours');
            $table->date('End_Date_Tours')->nullable();
            $table->mediumInteger('Price');
            $table->string('Notification_OPDA',191)->nullable();
            $table->integer('Profit')->default(0);
            $table->integer('Expenses');
            $table->mediumInteger('Privilegens_Price')->nullable();
            $table->mediumInteger('Children_price')->nullable();
            $table->mediumInteger('Amount_Place');
            $table->mediumInteger('Occupied_Place')->default(0);
            $table->tinyInteger('Confirmation_Tours')->default(0);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('buses_id')->references('id')
                ->on('buses');
            $table->foreign('routes_id')->references('id')
                ->on('routes');
            $table->foreign('type_tours_id')->references('id')
                ->on('type_tours')->onDelete('SET NULL');
            $table->foreign('albums_id')->references('id')
                ->on('albums')->onDelete('SET NULL');

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
