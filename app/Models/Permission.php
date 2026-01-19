<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['key', 'display_name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
