<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\ValueObjects\UserRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //عند الوصول إلى الدور تحويله إلى ValueObject
    public function getRoleAttribute($value): UserRole
    {
        return new UserRole($value);
    }

    // عند حفظ الدور تحويله إلى نص
    public function setRoleAttribute(UserRole|string $role): void
    {
        $this->attributes['role'] = $role instanceof UserRole ? $role->value() : $role;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['role'] = (string) $this->role;
        return $array;
    }

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

    //Relations
    public function reportedIssues()
    {
        return $this->hasMany(Issue::class, 'reporter_id');
    }

    public function assignedIssues()
    {
        return $this->hasMany(Issue::class, 'assignee_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
