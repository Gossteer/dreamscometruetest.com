<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('Name_Source', 191)->unique();
            $table->string('Site', 191)->unique();
            $table->bigInteger('Category_Sources_id')->unsigned();
            $table->string('Photo', 191);
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('Category_Sources_id')->references('id')
                ->on('category_sources')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}
