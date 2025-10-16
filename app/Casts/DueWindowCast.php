<?php

namespace App\Casts;

use App\ValueObjects\DueWindow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DueWindowCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!$value) {
            return null;
        }

        $data = json_decode($value, true);

        return DueWindow::fromArray($data);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
         if ($value instanceof DueWindow) {
            return json_encode($value->toArray());
        }

        if (is_array($value)) {
            return json_encode($value);
        }

        return $value;
    }
}
