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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nom_complet', 150)->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('region', 100)->nullable();
            $table->timestamp('date_inscription')->useCurrent();
            $table->timestamp('date_modification')->useCurrent()->useCurrentOnUpdate();
            $table->enum('statut', ['actif', 'inactif', 'supprimé'])->default('actif');
            $table->boolean('est_en_ligne')->default(false);
            $table->dateTime('derniere_connexion')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->index(['email', 'statut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
