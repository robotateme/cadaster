<?php

namespace App\DTOs\Collections;

use App\DTOs\ApiPlotDto;
use App\Models\Plot;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class PlotsCollection extends Collection
{
    /**
     * @param $key
     * @return \App\DTOs\ApiPlotDto
     */
    public function offsetGet($key) : ApiPlotDto
    {
        return parent::offsetGet($key);
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->items as $item) {
            if ($item instanceof Collection || $item instanceof DataTransferObject) {
                $array[] = $item->toArray();
            } else {
                $array[] = $item;
            }
        }

        return $array;
    }

    public function toModels(): static
    {
        foreach ($this->items as $k => $item) {
            if ($item instanceof DataTransferObject) {
                $this->items[$k] = (new Plot())->fill($item->toArray());
            } else {
                $this->items[$k] = $item;
            }
        }

        return $this;
    }
}