<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearningPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    public function courses()
    {
        return $this->hasMany(Course::class)->orderBy('order_index');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_learning_paths')
                    ->withPivot(['is_active', 'enrolled_at', 'completed_at'])
                    ->withTimestamps();
    }

    public function userLearningPaths()
    {
        return $this->hasMany(UserLearningPath::class);
    }
}
