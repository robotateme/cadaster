<?php

namespace App\DTOs;

use App\DTOs\Casts\StringArrayCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class PlotsFilterDto extends DataTransferObject
{
    #[CastWith(StringArrayCaster::class)]
    public array $cadastral_numbers = [];
}