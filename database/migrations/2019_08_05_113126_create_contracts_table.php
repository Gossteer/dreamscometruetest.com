<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('type_contracts_id')->unsigned()->nullable();
            $table->foreign('type_contracts_id')->references('id')
                ->on('type_contracts');
            $table->bigInteger('tours_id')->unsigned();
            $table->foreign('tours_id')->references('id')
                ->on('tours');
            $table->bigInteger('partners_id')->unsigned();
            $table->foreign('partners_id')->references('id')
                ->on('partners');
            $table->string('Document_Contract', 191);
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
        Schema::dropIfExists('contrancts');
    }
}
