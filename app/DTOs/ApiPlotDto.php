<?php

namespace App\DTOs;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class ApiPlotDto extends DataTransferObject
{
    #[MapFrom('attrs.plot_number')]
    public string $cn;

    #[MapFrom('attrs.plot_area')]
    public string $area;

    #[MapFrom('attrs.plot_price')]
    public string $price;

    #[MapFrom('attrs.plot_address')]
    public string $address;
}