<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique()->nullable();
            $table->string('order_id')->nullable();
            $table->string('previous_order_id')->nullable();
            $table->decimal('payment_amount', 10, 2);
            $table->decimal('enach_charges', 10, 2);
            $table->decimal('gst_on_enach_charges', 10, 2);
            $table->decimal('bounce_charges', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_mode')->nullable();
            $table->date('payment_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('loan_id');
            $table->integer('status')->default(0);
            $table->dateTime('payment_completed_date')->nullable();
            $table->text('billdesk_response')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_id')->references('id')->on('loan_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
