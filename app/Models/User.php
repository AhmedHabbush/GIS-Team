<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_image',
        'password',
        'role_id',
        'is_approved',
    ];

    protected $attributes = [
        'is_approved' => false,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's profile image URL
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        return asset('images/default-avatar.png');
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function pages()
    {
        return $this->belongsToMany(\App\Models\Page::class)->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(\App\Models\Document::class);
    }

    public function isRole(string $key): bool
    {
        return optional($this->role)->key === $key;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission(string $key): bool
    {
        if ($this->isRole('admin')) {
            return true;
        }

        return $this->permissions->contains('key', $key);
    }
}
