<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('news_id')->unsigned();
            $table->foreign('news_id')->references('id')
                ->on('news')->onDelete('CASCADE');
            $table->bigInteger('sources_id')->unsigned();
            $table->foreign('sources_id')->references('id')
                ->on('sources')->onDelete('CASCADE');
            $table->string('Link', 191);
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
        Schema::dropIfExists('posts');
    }
}
