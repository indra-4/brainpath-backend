<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatbotRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'keyword',
        'response',
        'priority',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'priority'  => 'integer',
        ];
    }
}
