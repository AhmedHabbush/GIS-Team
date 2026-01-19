<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'iframe_url', 'is_active'];
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
