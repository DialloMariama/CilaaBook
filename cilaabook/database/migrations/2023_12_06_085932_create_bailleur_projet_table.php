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
        Schema::create('bailleur_projet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projet_id');
            $table->unsignedBigInteger('bailleur_id');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->foreign('bailleur_id')->references('id')->on('bailleurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bailleur_projet');
    }
};
