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
        Schema::create('learning_path_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('path_id');
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->integer('sequence');
            $table->text('reason');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_path_items');
    }
};
