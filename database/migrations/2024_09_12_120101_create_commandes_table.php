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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->date('date_cmd')->default("now");;
            $table->integer('montant_total')->default(0);;
            $table->timestamps();
            $table->integer('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('vendeur_id');
            $table->foreign('vendeur_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
