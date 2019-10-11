<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewCategoryNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_category_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('new_category_id')->unsigned();
            $table->bigInteger('news_id')->unsigned();
            $table->boolean('LogicalDelete')->default(0);

            $table->foreign('news_id')->references('id')
                ->on('news')->onDelete('CASCADE');
            $table->foreign('new_category_id')->references('id')
                ->on('new_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attached__categories');
    }
}
