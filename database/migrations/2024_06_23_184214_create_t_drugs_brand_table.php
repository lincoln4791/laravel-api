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
        Schema::create('t_drug_brand', function (Blueprint $table) {
            $table->string('brand_id');
            $table->string('generic_id');
            $table->string('company_id');
            $table->string('brand_name');
            $table->string('form')->nullable();
            $table->string('strength')->nullable();
            $table->string('price')->nullable();
            $table->string('packsize')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_drug_brand');
    }
};
