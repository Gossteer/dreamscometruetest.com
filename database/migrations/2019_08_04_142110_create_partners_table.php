<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('type_activities_id')->unsigned()->nullable();
            $table->foreign('type_activities_id')->references('id')
                ->on('type_activities')->onDelete('SET NULL');
            $table->string('Name_Partners', 191)->unique();
            $table->string('Phone_Number',20);
            $table->string('Address', 191)->default('Нет');
            $table->string('Email', 191)->default('Нет');
            $table->string('Site', 191)->default('Нет');
            $table->string('Conract_Partners', 191)->nullable();
            $table->string('INN', 191)->unique()->nullable();
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
        Schema::dropIfExists('partners');
    }
}
