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
        Schema::table('stages', function (Blueprint $table) {
            $table->dropForeign(['sales_funnel_id']); // Remove chave estrangeira, se existir
            $table->dropColumn('sales_funnel_id'); // Remove a coluna
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stages', function (Blueprint $table) {
            $table->unsignedBigInteger('sales_funnel_id')->nullable(); // Adiciona a coluna novamente caso precise reverter
            $table->foreign('sales_funnel_id')->references('id')->on('sales_funnels')->onDelete('cascade');
        });
    }
};
