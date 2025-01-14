<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('email_otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number');
            $table->string('alternate_phone_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('employment_type')->nullable();
            $table->double('income_amount')->nullable();
            $table->string('salary_slip')->nullable();
            $table->string('bank_statement')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->integer('company_pincode')->nullable();
            $table->string('company_city')->nullable();
            $table->string('relationship_status')->nullable();
            $table->string('selfie')->nullable();
            $table->string('pan_card_number')->nullable();
            $table->bigInteger('aadhaar_number')->nullable();
            $table->string('current_address')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('relative1_name')->nullable();
            $table->integer('relative1_relation_id')->nullable();
            $table->string('relative1_phone_number')->nullable();
            $table->string('relative2_name')->nullable();
            $table->integer('relative2_relation_id')->nullable();
            $table->string('relative2_phone_number')->nullable();
            $table->bigInteger('credit_limit')->nullable();
            $table->bigInteger('cibil_score')->nullable();
            $table->date('cibil_score_check_date')->nullable();
            $table->string('password')->nullable();
            $table->string('my_referral_code')->nullable();
            $table->string('referred_by')->nullable();
            $table->integer('cashback_earned')->default(0);
            $table->integer('is_active')->default(1);
            $table->integer('is_notification')->default(1);
            $table->integer('loan_status')->default(0);
            $table->integer('cibil_status')->default(0);
            $table->integer('loan_stage')->default(0);
            $table->integer('user_application_status')->default(0);
            $table->integer('business_enquiry_status')->default(0);
            $table->integer('is_defaulter')->default(0);
            $table->date('defaulter_date')->nullable();
            $table->string('firebase_token')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('geo_location')->nullable();
            $table->string('device_id')->nullable();
            $table->text('device_info')->nullable();
            $table->string('jwt_token')->nullable();
            $table->rememberToken();
            $table->integer('role_id')->default(2);
            $table->integer('esign_otp')->nullable();
            $table->text('esign_verification_response')->nullable();
            $table->string('aadhaar_name')->nullable();
            $table->date('aadhaar_dob')->nullable();
            $table->text('aadhaar_image')->nullable();
            $table->text('aadhaar_verification_response')->nullable();
            $table->string('pan_name')->nullable();
            $table->text('pan_verification_response')->nullable();
            $table->text('selfie_verification_response')->nullable();
            $table->text('cibil_score_response')->nullable();
            $table->text('bank_verification_response')->nullable();
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
        Schema::dropIfExists('users');
    }
}
