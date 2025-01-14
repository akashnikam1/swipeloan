<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessLoanRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_loan_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('age_of_applicant');
            $table->string('consitution_of_applicant');
            $table->string('type_of_bank_account');
            $table->string('office_ownership');
            $table->string('residence_ownership');
            $table->string('business_vintage');
            $table->string('bank_statement');
            $table->string('shop_act');
            $table->string('itr');
            $table->string('gstin')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_loan_requirements');
    }
}
