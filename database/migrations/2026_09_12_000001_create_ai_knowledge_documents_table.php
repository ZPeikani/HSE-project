<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_knowledge_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source_name');
            $table->string('source_type')->default('iranian_regulation');
            $table->string('document_type')->nullable();
            $table->string('issuing_authority')->nullable();
            $table->string('category')->nullable();
            $table->string('language', 10)->default('fa');
            $table->string('version')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('status')->default('active');
            $table->text('source_url')->nullable();
            $table->string('original_file_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['source_type', 'status']);
            $table->index(['category', 'status']);
        });

        Schema::create('ai_knowledge_chunks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_knowledge_document_id')
                ->constrained('ai_knowledge_documents')
                ->cascadeOnDelete();
            $table->unsignedInteger('chunk_index')->default(0);
            $table->string('chapter')->nullable();
            $table->string('article_number')->nullable();
            $table->string('paragraph_number')->nullable();
            $table->unsignedInteger('page_number')->nullable();
            $table->longText('content');
            $table->timestamps();

            $table->index(['ai_knowledge_document_id', 'chunk_index']);
            $table->index(['article_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_knowledge_chunks');
        Schema::dropIfExists('ai_knowledge_documents');
    }
};
