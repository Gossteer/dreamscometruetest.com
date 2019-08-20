<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePRFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_r_f_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->mediumInteger('PRF_Series');
            $table->mediumInteger('PRF_Number');
            $table->date('Date_Issue_PRF');
            $table->text('Issued_PRF');
            $table->string('Code_Division_PRF',10);
            $table->string('Photo_PRF', 191)->nullable();
            $table->boolean('Confirm')->default(0);
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
        Schema::dropIfExists('p_r_f_s');
    }
}
