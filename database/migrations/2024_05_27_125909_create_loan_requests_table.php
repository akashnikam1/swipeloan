<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('loan_user_id');
            $table->string('loan_number')->unique();
            $table->integer('loan_status')->default(0);
            $table->integer('is_auto_debit')->default(1);
            $table->decimal('loan_amount', 10, 2);
            $table->decimal('documentation_fee', 10, 2);
            $table->decimal('gst_on_documentation_fee', 10, 2);
            $table->decimal('up_front_charges', 10, 2);
            $table->decimal('gst_on_up_front_charges', 10, 2);
            $table->decimal('net_disbursed_amount', 10, 2);
            $table->decimal('pre_interest_amount', 10, 2);
            $table->decimal('disbursed_amount', 10, 2);
            $table->date('disbursed_date')->nullable();
            $table->decimal('emi_amount', 10, 2);
            $table->integer('tenure');
            $table->integer('number_of_emi');
            $table->decimal('total_emi_amount', 10, 2);
            $table->date('emi_start_date');
            $table->date('emi_end_date');
            $table->date('due_on');
            $table->decimal('interest_rate', 10, 2);
            $table->decimal('post_service_fee', 10, 2);
            $table->decimal('gst_on_post_service_fee', 10, 2);
            $table->decimal('technology_fee', 10, 2);
            $table->decimal('gst_on_technology_fee', 10, 2);
            $table->string('loan_type');
            $table->integer('payment_mode')->nullable();
            $table->unsignedBigInteger('nbfc_id')->nullable();
            $table->string('nbfc_name')->nullable();
            $table->string('razorpay_key')->nullable();
            $table->string('lender');
            $table->date('pending_on');
            $table->date('approved_on');
            $table->date('ongoing_on');
            $table->date('closed_on');
            $table->date('declined_on');
            $table->string('declined_reason')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_user_id')->references('id')->on('loan_users_details')->onDelete('cascade');
          	$table->foreign('nbfc_id')->references('id')->on('nbfcs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_requests');
    }
}
