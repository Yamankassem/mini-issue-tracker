<?php

namespace App\ValueObjects;

class DueWindow
{
    public function __construct(
        public ?string $start = null,
        public ?string $end = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['start'] ?? null,
            $data['end'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
