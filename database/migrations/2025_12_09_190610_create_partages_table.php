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
        Schema::create('partages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contenu_id')->constrained('contenu')->onDelete('cascade');
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs')->onDelete('set null');
            $table->enum('type_partage', ['email', 'facebook', 'whatsapp', 'twitter', 'lien'])->default('lien');
            $table->timestamp('date_partage')->useCurrent();
            $table->index(['contenu_id', 'date_partage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partages');
    }
};
