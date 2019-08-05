<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attached_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('new_category_id')->unsigned()->unique();
            $table->foreign('new_category_id')->references('id')
                ->on('new_categories');
            $table->bigInteger('news_id')->unsigned()->unique();
            $table->foreign('news_id')->references('id')
                ->on('news')->onDelete('CASCADE');
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
        Schema::dropIfExists('attached__categories');
    }
}
