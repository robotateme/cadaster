<?php

namespace App\DTOs\Collections;

use App\DTOs\PlotDto;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class PlotsCollection extends Collection
{
    /**
     * @param $key
     * @return \App\DTOs\PlotDto
     */
    public function offsetGet($key) : PlotDto
    {
        return parent::offsetGet($key);
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->items as $k => $item) {
            if ($item instanceof Collection || $item instanceof DataTransferObject) {
                $array[] = $item->toArray();
            } else {
                $array[] = $item;
            }
        }

        return $array;
    }
}