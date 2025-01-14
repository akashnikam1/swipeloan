<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateENachTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_nach_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('enach_charges', 10, 2);
            $table->decimal('gst_on_enach_charges', 10, 2);
            $table->decimal('bounce_charges', 10, 2);
            $table->integer('enach_status'); 
            $table->integer('is_enach');
            $table->date('enach_date');
            $table->json('enach_response');
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_nach_transactions');
    }
}
