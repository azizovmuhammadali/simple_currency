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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('Code');
            $table->string('Ccy');
            $table->string('CcyNm_RU');
            $table->string('CcyNm_UZ');
            $table->string('CcyNm_UZC');
            $table->string('Nominal');
            $table->string('Rate');
            $table->string('Diff');
            $table->string('Date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
