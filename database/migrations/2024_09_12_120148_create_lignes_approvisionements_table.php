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
        Schema::create('lignes_approvisionements', function (Blueprint $table) {
            $table->id();
            $table->integer('qte_approvisionner');
            $table->integer('prod_id');
            $table->foreign('prod_id')->references('id')->on('produits');
            $table->integer('apprivisionement_id');
            $table->foreign('apprivisionement_id')->references('id')->on('approvisionements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_approvisionements');
    }
};
