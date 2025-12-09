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
        Schema::create('stats_utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->unique()->constrained('utilisateurs')->onDelete('cascade');
            $table->integer('nombre_favoris')->default(0);
            $table->integer('nombre_consultations')->default(0);
            $table->integer('nombre_partages')->default(0);
            $table->integer('nombre_telechargements')->default(0);
            $table->integer('nombre_playlists')->default(0);
            $table->timestamp('date_dernier_calcul')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats_utilisateurs');
    }
};
