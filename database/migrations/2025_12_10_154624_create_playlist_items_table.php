<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('playlist_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('playlist_id');
            $table->unsignedBigInteger('contenu_id');
            $table->timestamps();

            $table->foreign('playlist_id')->references('id')->on('playlists')->cascadeOnDelete();
            $table->foreign('contenu_id')->references('id')->on('contenus')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('playlist_items');
    }
};
