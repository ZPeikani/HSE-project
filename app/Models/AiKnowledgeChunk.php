<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiKnowledgeChunk extends Model
{
    protected $fillable = [
        'ai_knowledge_document_id',
        'chunk_index',
        'chapter',
        'article_number',
        'paragraph_number',
        'page_number',
        'content',
    ];

    public function document(): BelongsTo
    {
        return $this->belongsTo(
            AiKnowledgeDocument::class,
            'ai_knowledge_document_id'
        );
    }
}
