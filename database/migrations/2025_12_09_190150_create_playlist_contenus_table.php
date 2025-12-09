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
        Schema::create('playlist_contenus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playlist_id')->constrained('playlists')->onDelete('cascade');
            $table->foreignId('contenu_id')->constrained('contenu')->onDelete('cascade');
            $table->integer('ordre');
            $table->timestamp('date_ajout')->useCurrent();
            $table->unique(['playlist_id', 'contenu_id']);
            $table->index(['playlist_id', 'contenu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_contenus');
    }
};
