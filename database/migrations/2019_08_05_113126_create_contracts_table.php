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
            $table->string('Name_Contract_doc', 191);
            $table->integer('Salary')->default(0);
            $table->bigInteger('tours_id')->unsigned();
            $table->bigInteger('partners_id')->unsigned();
            $table->string('Document_Contract', 191);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('partners_id')->references('id')
                ->on('partners');
            $table->foreign('tours_id')->references('id')
                ->on('tours');
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
