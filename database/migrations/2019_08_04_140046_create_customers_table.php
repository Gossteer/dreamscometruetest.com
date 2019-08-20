<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('Name', 80);
            $table->string('Surname', 80);
            $table->string('Middle_Name', 80)->nullable();
            $table->smallInteger('White_Days')->default(0);
            $table->smallInteger('Black_Days')->default(0);
            $table->smallInteger('Number_Customers_Listed')->default(0);
            $table->string('Phone_Number_Customer', 20)->unique();
            $table->date('Data_Registration')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('Phone_Customer_Inviter', 20)->nullable();
            $table->bigInteger('sources_id')->unsigned()->nullable();
            $table->foreign('sources_id')->references('id')
                ->on('sources');
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')
                ->on('users')->onDelete('SET NULL');
            $table->bigInteger('z_g_p_s_id')->unsigned()->nullable();
            $table->foreign('z_g_p_s_id')->references('id')
                ->on('z_g_p_s')->onDelete('SET NULL');
            $table->bigInteger('p_r_f_s_id')->unsigned()->nullable();
            $table->foreign('p_r_f_s_id')->references('id')
                ->on('p_r_f_s')->onDelete('SET NULL');
            $table->date('Date_Birth_Customer')->nullable();
            $table->string('Preferred_Type_Tours', 191)->nullable();
            $table->boolean('floor');
            $table->smallInteger('Age_Group')->nullable();
            $table->tinyInteger('Condition')->default(0);
            $table->mediumInteger('Debt')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
