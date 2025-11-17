<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerSkill extends Model
{
    use HasFactory;

    // explicit table name
    protected $table = 'volunteer_skills';

    protected $primaryKey = 'volunteer_skill_id';

    protected $fillable = [
        'volunteer_id',
        'skill_id',
        'proficiency_level',
    ];

    protected $casts = [
        'proficiency_level' => 'string',
    ];

    // Relationships
    public function volunteer() {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'volunteer_id');
    }

    public function skill() {
        return $this->belongsTo(Skill::class, 'skill_id', 'skill_id');
    }

    // Helper methods
    public function getFullNameAttribute()
    {
        // If pivot stores volunteer names (unlikely), keep fallback; otherwise remove
        return trim((($this->first_name ?? '') . ' ' . ($this->last_name ?? '')));
    }

    public function incrementEventCompletion()
    {
        if ($this->exists && $this->getAttribute('events_completed') !== null) {
            $this->increment('events_completed');
        }
    }

    public function addHours($hours)
    {
        if ($this->exists && $this->getAttribute('total_hours') !== null) {
            $this->increment('total_hours', $hours);
        }
    }
}