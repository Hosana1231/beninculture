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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->string('titre', 200)->nullable();
            $table->text('message');
            $table->enum('type_notification', ['like', 'comment', 'partage', 'nouveau_contenu', 'systeme'])->default('systeme');
            $table->string('url_lien', 300)->nullable();
            $table->boolean('est_lu')->default(false);
            $table->timestamp('date_creation')->useCurrent();
            $table->index(['utilisateur_id', 'est_lu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
