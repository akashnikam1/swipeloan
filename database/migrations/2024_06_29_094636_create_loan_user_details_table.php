<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_user_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('alternate_phone_number');
            $table->date('dob');
            $table->string('employment_type');
            $table->string('relationship_status');
            $table->string('selfie');
            $table->string('current_address');
            $table->integer('pincode');
            $table->double('income_amount');
            $table->string('salary_slip');
            $table->string('bank_statement');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->string('company_name');
            $table->string('company_address');
            $table->integer('company_pincode');
            $table->string('company_city');
            $table->bigInteger('credit_limit');
            $table->bigInteger('cibil_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_user_details');
    }
}
