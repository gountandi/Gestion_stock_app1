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
        Schema::create('approvisionements', function (Blueprint $table) {
            $table->id();
            $table->integer('prix_achat_unitaire');
            $table->integer('gerant_id');
            $table->foreign('gerant_id')->references('id')->on('users');
            $table->integer('fournisseur_id');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
            $table->date('date_livraison')->default('now');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvisionements');
    }
};
