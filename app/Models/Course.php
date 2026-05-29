<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
        'tags',
        'order_index',
        'duration_minutes',
        'skills',
        'is_published',
        'external_url',
        'level',
        'summary',
        'learning_points',
        'duration_text',
    ];

    protected function casts(): array
    {
        return [
            'tags'            => 'array',
            'is_published'    => 'boolean',
            'learning_points' => 'array',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    /**
     * Courses that are prerequisites FOR this course.
     */
    public function prerequisites()
    {
        return $this->belongsToMany(
            Course::class,
            'course_prerequisites',
            'course_id',
            'prerequisite_id'
        );
    }

    /**
     * Courses that require THIS course as a prerequisite.
     */
    public function dependents()
    {
        return $this->belongsToMany(
            Course::class,
            'course_prerequisites',
            'prerequisite_id',
            'course_id'
        );
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }


    public function recommendationLogsAsSource()
    {
        return $this->hasMany(RecommendationLog::class, 'source_course_id');
    }

    public function recommendationLogsAsTarget()
    {
        return $this->hasMany(RecommendationLog::class, 'recommended_course_id');
    }
}
