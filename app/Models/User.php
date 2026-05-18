<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_new_user',
        'has_it_knowledge',
        'interest',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_new_user'       => 'boolean',
            'has_it_knowledge'  => 'boolean',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function recommendationLogs()
    {
        return $this->hasMany(RecommendationLog::class);
    }
}
