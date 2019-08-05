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
            $table->date('Data_Registration');
            $table->bigInteger('customers_id')->unsigned()->nullable();
            $table->foreign('customers_id')->references('id')
                ->on('customers');
            $table->date('Date_Birth_Customer')->nullable();
            $table->string('Preferred_Type_Tours', 191)->nullable();
            $table->tinyInteger('floor');
            $table->string('Registration_Address', 191);
            $table->smallInteger('Age_Group')->nullable();
            $table->mediumInteger('PRF_Series')->nullable();
            $table->mediumInteger('PRF_Number')->nullable();
            $table->date('Date_Issue_PRF')->nullable();
            $table->text('Issued_PRF')->nullable();
            $table->string('Code_Division_PRF',10)->nullable();
            $table->mediumInteger('ZGP_Series')->nullable();
            $table->mediumInteger('ZGP_Number')->nullable();
            $table->date('Date_Issue_ZGP')->nullable();
            $table->text('Issued_ZGP')->nullable();
            $table->date('Valid_Until_ZGP')->nullable();
            $table->tinyInteger('Condition')->default(0);
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
