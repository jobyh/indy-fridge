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
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('name');
            $table->string('brewery');
            $table->string('style');
            $table->string('description');
            $table->json('hops');
            $table->json('tags');
            $table->float('abv');
            $table->integer('price');
            $table->integer('stock');
            $table->string('size');
            $table->timestamp('published_at');
            $table->timestamp('modified_at')->nullable();
            $table->timestamps();
            $table->index('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
