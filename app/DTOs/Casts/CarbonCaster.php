<?php

namespace App\DTOs\Casts;

use Carbon\Carbon;
use Spatie\DataTransferObject\Caster;

class CarbonCaster implements Caster
{

    public function cast(mixed $value): Carbon
    {
        return Carbon::now();
    }
}