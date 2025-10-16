<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class UserRole
{
    private string $role;

    private static array $allowedRoles = [
        'reporter',
        'commenter',
        'assignee',
    ];

    public function __construct(string $role)
    {
        if (!in_array($role, self::$allowedRoles)) {
            throw new InvalidArgumentException("الدور غير صالح: $role");
        }
        $this->role = $role;
    }

    
    public function __toString(): string
    {
        return $this->role;
    }

    public function value(): string
    {
        return $this->role;
    }

    public static function allowedRoles(): array
    {
        return self::$allowedRoles;
    }

    // لإضافة دور جديد مستقبلًا
    public static function addRole(string $role): void
    {
        if (!in_array($role, self::$allowedRoles)) {
            self::$allowedRoles[] = $role;
        }
    }

}
