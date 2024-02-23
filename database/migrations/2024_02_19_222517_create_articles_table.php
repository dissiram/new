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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->unique()->nullable(false);
            $table->string('slug')->unique()->nullable(false);
            $table->text('contenu')->nullable(false);
            $table->text('image')->nullable();
            $table->boolean('published')->default(false);
            
            $table->foreignId('user_id')->cascadeOnDelete();
            
            $table->foreignId('categorie_id')->cascadeOnDelete()
                ->comment("La catégorie à laquelle l'article est associé");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
