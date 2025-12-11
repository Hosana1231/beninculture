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
        Schema::create('medias', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('contenu_id');
    $table->enum('type_media', ['image','audio','video']);
    $table->string('url');
    $table->string('extension')->nullable();
    $table->integer('taille')->nullable(); // en ko
    $table->timestamps();

    $table->foreign('contenu_id')->references('id')->on('contenus')->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
