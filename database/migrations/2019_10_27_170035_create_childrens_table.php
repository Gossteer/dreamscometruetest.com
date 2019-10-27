<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('passengers_id')->unsigned();
            $table->string('Name', 80);
            $table->string('Surname', 80);
            $table->string('Middle_Name', 80)->nullable();
            $table->smallInteger('Occupied_Place_Bus');
            $table->boolean('Fry')->default(0);
            $table->date('Date_Birth_Day');
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('passengers_id')->references('id')
                ->on('passengers')->onDelete('CASCADE');
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
        Schema::dropIfExists('childrens');
    }
}
