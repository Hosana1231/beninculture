<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('telechargements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contenu_id');
            $table->timestamp('telecharge_le')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('contenu_id')->references('id')->on('contenus')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telechargements');
    }
};
