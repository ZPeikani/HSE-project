<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AiKnowledgeDocument extends Model
{
    protected $fillable = [
        'title',
        'source_name',
        'source_type',
        'document_type',
        'issuing_authority',
        'category',
        'language',
        'version',
        'approval_date',
        'status',
        'source_url',
        'original_file_path',
        'description',
    ];

    protected $casts = [
        'approval_date' => 'date',
    ];

    public function chunks(): HasMany
    {
        return $this->hasMany(
            AiKnowledgeChunk::class,
            'ai_knowledge_document_id'
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}