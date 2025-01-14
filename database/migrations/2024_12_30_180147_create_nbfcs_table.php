<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbfcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbfcs', function (Blueprint $table) {
            $table->id();
            $table->string('nbfc_name');
            $table->decimal('payment_limit', 10, 2);
            $table->string('razorpay_key');
            $table->string('razorpay_secret');
            $table->string('razorpayX_key');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('nbfcs');
    }
}
