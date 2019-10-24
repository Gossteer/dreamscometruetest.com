<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name_Stock');
            $table->mediumInteger('Stock_Price');
            $table->date('Start_Date_Tours');
            $table->date('End_Date_Tours')->nullable();
            $table->integer('Amount')->nullable();
            $table->text('Description')->default('Подробности по телефону.');
            $table->boolean('Access')->default(0);
            $table->boolean('LogicalDelete')->default(0);
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
        Schema::dropIfExists('stocks');
    }
}
