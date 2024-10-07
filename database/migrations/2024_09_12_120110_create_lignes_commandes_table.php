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
        Schema::create('lignes_commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('qte_ligne');
            $table->integer('montant');
            $table->timestamps();
            $table->bigInteger("prod_id");
            $table->bigInteger("cmd_id");
            $table->foreign("prod_id")->references("id")->on("produits")->onDelete('cascade');
            $table->foreign("cmd_id")->references("id")->on("commandes")->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignes_commandes');
    }
};
