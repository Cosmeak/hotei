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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('craftman_id')->constrained('craftmen')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('category');
            $table->integer('duration');
            $table->json('materials');
            $table->integer('difficulty');
            $table->boolean('is_draft')->default(true);
            $table->integer('cost')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
