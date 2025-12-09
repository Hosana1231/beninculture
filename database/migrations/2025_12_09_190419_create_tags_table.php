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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('nom_tag', 100)->unique();
            $table->string('slug_tag', 100)->unique();
            $table->integer('nombre_utilisations')->default(0);
            $table->boolean('est_tendance')->default(false);
            $table->timestamp('date_creation')->useCurrent();
            $table->index(['slug_tag', 'est_tendance']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
