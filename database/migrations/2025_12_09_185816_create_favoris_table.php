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
        Schema::create('favoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->foreignId('contenu_id')->constrained('contenu')->onDelete('cascade');
            $table->enum('type_favori', ['like', 'bookmark', 'playlist'])->default('like');
            $table->timestamp('date_ajout')->useCurrent();
            $table->unique(['utilisateur_id', 'contenu_id', 'type_favori']);
            $table->index(['utilisateur_id', 'contenu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoris');
    }
};
