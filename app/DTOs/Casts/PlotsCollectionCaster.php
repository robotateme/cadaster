<?php

namespace App\DTOs\Casts;

use App\DTOs\Collections\PlotsCollection;
use App\DTOs\PlotDto;
use Spatie\DataTransferObject\Caster;

class PlotsCollectionCaster implements Caster
{
    /**
     * @param  mixed  $value
     * @return \App\DTOs\Collections\PlotsCollection
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function cast(mixed $value): PlotsCollection
    {
        return new PlotsCollection(array_map(fn(array $data) => new PlotDto(...$data), $value));
    }
}