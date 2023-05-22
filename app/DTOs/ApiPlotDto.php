<?php

namespace App\DTOs;

use App\DTOs\Casts\CarbonCaster;
use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class ApiPlotDto extends DataTransferObject
{
    #[MapFrom('attrs.plot_number')]
    public string $cadastral_number;

    #[MapFrom('attrs.plot_area')]
    public string $area;

    #[MapFrom('attrs.plot_price')]
    public string $price;

    #[MapFrom('attrs.plot_address')]
    public string $address;

    #[CastWith(CarbonCaster::class)]
    public Carbon $updated_at;
}