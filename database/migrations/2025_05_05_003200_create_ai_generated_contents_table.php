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
        Schema::create('ai_generated_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('content_type', ['video_script', 'module', 'quiz', 'summary', 'explanation']);
            $table->string('title');
            $table->text('content');
            $table->text('prompt');
            
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('created_by');
            $table->boolean('is_published'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_generated_contents');
    }
};