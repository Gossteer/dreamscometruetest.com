<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassportDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('Passport_Series');
            $table->mediumInteger('Passport_Id');
            $table->string('Address')->nullable();
            $table->boolean('Confirmation')->default(0);
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
        Schema::dropIfExists('passport__dates');
    }
}
