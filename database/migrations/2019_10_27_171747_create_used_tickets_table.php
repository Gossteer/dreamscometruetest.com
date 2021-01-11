<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsedTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('passengers_id')->unsigned()->onDelete('SET NULL');
            $table->bigInteger('tickets_id')->unsigned()->onDelete('CASCADE');
            $table->mediumInteger('Amount');
            $table->boolean('Confirmation')->default(0);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('passengers_id')->references('id')
                ->on('passengers');
            $table->foreign('tickets_id')->references('id')
                ->on('tickets');
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
        Schema::dropIfExists('used_tickets');
    }
}
