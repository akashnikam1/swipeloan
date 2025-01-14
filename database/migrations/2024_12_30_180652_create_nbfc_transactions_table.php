<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbfcTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbfc_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nbfc_id');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_type');
            $table->timestamps();

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
        Schema::dropIfExists('nbfc_transactions');
    }
}
