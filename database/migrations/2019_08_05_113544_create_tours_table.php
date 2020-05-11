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
            $table->boolean('Seating');
            $table->string('Duration', 191)->default('Подробности по телефону.');
            $table->boolean('Popular')->default(0);
            $table->tinyInteger('Assessment')->default(0);
            $table->boolean('ZGP')->default(0);
            $table->boolean('PRF')->default(0);
            $table->string('Name_Tours', 191);
            $table->string('Start_point', 191);
            $table->text('Description')->nullable();
            $table->text('Program')->nullable();
            $table->datetime('Start_Date_Tours');
            $table->datetime('End_Date_Tours')->nullable();
            $table->mediumInteger('Price');
            $table->boolean('Confidentiality')->default(0);
            $table->mediumInteger('Privilegens_Price')->nullable();
            $table->mediumInteger('Children_price')->nullable();
            $table->string('Notification_OPDA',191)->nullable();
            $table->integer('Profit')->default(0);
            $table->integer('Expenses');
            $table->mediumInteger('Amount_Place');
            $table->mediumInteger('Occupied_Place')->default(0);
            $table->tinyInteger('Confirmation_Tours')->default(0);
            $table->boolean('LogicalDelete')->default(0);

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
