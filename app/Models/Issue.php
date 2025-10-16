<?php

namespace App\Models;

use App\Casts\DueWindowCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'reporter_id',
        'assignee_id',
        'code',
        'title',
        'description',
        'status',
        'priority',
        'due_window',
    ];

    protected $casts = [
        'due_window' => DueWindowCast::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($issue) {
            if (empty($issue->code)) {
                $issue->code = strtoupper('ISSUE-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT));
            }
        });
    }

    // Relations
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }


    // Mutator: force code uppercase
    protected function Code(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper($value)
        );
    }

    // Accessor: ucfirst title
    protected function Title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }

    // Scopes
    public function scopeOpen($q)
    {
        return $q->where('status', 'open');
    }
    public function scopeUrgent($q)
    {
        return $q->where('priority', 'high');
    }

}
