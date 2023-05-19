<?php

namespace App\DTOs;

use App\DTOs\Casts\PlotsCollectionCaster;
use App\DTOs\Collections\PlotsCollection;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class PlotsListDto extends DataTransferObject
{
    #[CastWith(PlotsCollectionCaster::class)]
    public PlotsCollection $plots;
}