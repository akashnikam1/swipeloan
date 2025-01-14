<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('referral_amount', 10, 2);
            $table->string('home_screen_video_link')->nullable();
            $table->integer('payment_mode');
            $table->integer('pincode_note');
            $table->string('version')->nullable();
            $table->integer('is_force_update');
            $table->decimal('credit_report_amount', 10, 2);
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
        Schema::dropIfExists('general_settings');
    }
}
