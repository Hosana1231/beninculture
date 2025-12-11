<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contenus', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->string('slug')->unique();
    $table->unsignedBigInteger('categorie_id');
    $table->unsignedBigInteger('user_id'); // auteur ou contributeur
    $table->enum('type_contenu', ['musique','video','art','tradition','lieu','histoire']);
    $table->text('description')->nullable();
    $table->string('couleur_debut')->nullable();
    $table->string('couleur_fin')->nullable();
    $table->integer('vues')->default(0);
    $table->integer('likes')->default(0);
    $table->boolean('est_featured')->default(false);
    $table->timestamps();

    $table->foreign('categorie_id')->references('id')->on('categories')->cascadeOnDelete();
    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
