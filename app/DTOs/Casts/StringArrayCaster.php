<?php

namespace App\DTOs\Casts;

use Spatie\DataTransferObject\Caster;

class StringArrayCaster implements Caster
{

    public function cast(mixed $value): array
    {
        return array_map(fn ($item) => trim($item) , explode(',', $value));
    }
}