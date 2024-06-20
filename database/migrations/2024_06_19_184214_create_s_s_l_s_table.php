<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('s_s_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id');
            $table->string('val_id')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('card_type')->nullable();
            $table->decimal('store_amount', 8, 2)->nullable();
            $table->string('card_no')->nullable();
            $table->string('bank_tran_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('tran_date')->nullable();
            $table->string('currency')->nullable();
            $table->string('card_issuer')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_issuer_country')->nullable();
            $table->string('card_issuer_country_code')->nullable();
            $table->string('store_id')->nullable();
            $table->string('verify_sign')->nullable();
            $table->text('verify_key')->nullable();
            $table->string('cus_fax')->nullable();
            $table->string('currency_type')->nullable();
            $table->decimal('currency_amount', 8, 2)->nullable();
            $table->decimal('currency_rate', 10, 4)->nullable();
            $table->decimal('base_fair', 8, 2)->nullable();
            $table->string('value_a')->nullable();
            $table->string('value_b')->nullable();
            $table->string('value_c')->nullable();
            $table->string('value_d')->nullable();
            $table->integer('risk_level')->nullable();
            $table->string('risk_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_s_l_s');
    }
};
