<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneNombersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_nombers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('partners_id')->unsigned()->nullable();
            $table->string('Representative',191)->default('Не имеется');
            $table->string('Phone_Number',20);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('partners_id')->references('id')
                ->on('partners')->onDelete('CASCADE');
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
        Schema::dropIfExists('phone_nombers');
    }
}
