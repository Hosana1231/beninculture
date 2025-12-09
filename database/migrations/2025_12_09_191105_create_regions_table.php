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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_region', 100)->unique();
            $table->string('slug_region', 100)->unique();
            $table->text('description')->nullable();
            $table->string('image_couverture', 500)->nullable();
            $table->integer('nombre_contenus')->default(0);
            $table->index('slug_region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
