<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFile extends Model
{
    protected $fillable = [
        'document_id',
        'file_path',
        'original_name',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
