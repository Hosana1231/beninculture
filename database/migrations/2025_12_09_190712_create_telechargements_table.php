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
        Schema::create('telechargements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contenu_id')->constrained('contenu')->onDelete('cascade');
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->onDelete('set null');
            $table->enum('qualite', ['basse', 'moyenne', 'haute', 'maximale'])->default('haute');
            $table->timestamp('date_telechargement')->useCurrent();
            $table->index(['contenu_id', 'date_telechargement']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telechargements');
    }
};
