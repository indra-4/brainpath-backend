<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecommendationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'source_course_id',
        'recommended_course_id',
        'similarity_score',
        'was_clicked',
    ];

    protected function casts(): array
    {
        return [
            'similarity_score' => 'float',
            'was_clicked'      => 'boolean',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sourceCourse()
    {
        return $this->belongsTo(Course::class, 'source_course_id');
    }

    public function recommendedCourse()
    {
        return $this->belongsTo(Course::class, 'recommended_course_id');
    }
}
