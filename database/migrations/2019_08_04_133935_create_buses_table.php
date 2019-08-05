<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('Brand_Bus', 191);
            $table->string('State_Registration_Number', 191);
            $table->date('Year_Issue');
            $table->string('Diagnostic_card', 191);
            $table->date('Validity_Date');
            $table->smallInteger('Amount_Place_Bus');
            $table->boolean('Tachograph')->default(0);
            $table->boolean('Glonas_GPS')->default(0);
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
        Schema::dropIfExists('buses');
    }
}
