<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'company',
        'types',
        'projects',
        'nationality',
        'square',
        'camp',
        'pilgrims_count',
        'notes',
        'status',
    ];
    protected $casts = [
        'types' => 'array',
        'projects' => 'array',
    ];
    public function files()
    {
        return $this->hasMany(DocumentFile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getMainFileAttribute()
    {
        return $this->files->first();
    }

}
