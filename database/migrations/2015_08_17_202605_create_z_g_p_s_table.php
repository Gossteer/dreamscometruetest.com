<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZGPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_g_p_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->mediumInteger('ZGP_Series');
            $table->mediumInteger('ZGP_Number');
            $table->date('Date_Issue_ZGP');
            $table->text('Issued_ZGP');
            $table->date('Valid_Until_ZGP');
            $table->string('Photo_ZGP',191)->nullable();
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
        Schema::dropIfExists('z_g_p_s');
    }
}
