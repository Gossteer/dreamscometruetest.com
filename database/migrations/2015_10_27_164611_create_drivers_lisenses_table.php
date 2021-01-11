<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversLisensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers_lisenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('Driving_License_Series');
            $table->mediumInteger('Driver_License_Id');
            $table->date('Date_Driver_License');
            $table->bigInteger('driving_license_categories_id')->unsigned()->onDelete('SET NULL');
            $table->boolean('Confirmation')->default(0);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('driving_license_categories_id')->references('id')
                ->on('driving_license_categories');
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
        Schema::dropIfExists('drivers__lisenses');
    }
}
