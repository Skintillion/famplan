<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chore extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_id',
        'assigned_to',
        'title',
        'description',
        'frequency',
        'due_date',
        'completed_at',
        'priority',
        'status',
        'points',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function assignedMember(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class, 'assigned_to');
    }
}
