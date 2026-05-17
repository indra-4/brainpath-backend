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
        'current_path_id',
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

    public function currentPath()
    {
        return $this->belongsTo(LearningPath::class, 'current_path_id');
    }

    public function learningPaths()
    {
        return $this->belongsToMany(LearningPath::class, 'user_learning_paths')
                    ->withPivot(['is_active', 'enrolled_at', 'completed_at'])
                    ->withTimestamps();
    }

    public function userLearningPaths()
    {
        return $this->hasMany(UserLearningPath::class);
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function interactions()
    {
        return $this->hasMany(UserInteraction::class);
    }

    public function recommendationLogs()
    {
        return $this->hasMany(RecommendationLog::class);
    }
}
