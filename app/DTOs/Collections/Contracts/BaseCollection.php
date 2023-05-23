<?php

namespace App\DTOs\Collections\Contracts;

use App\Models\Plot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseCollection extends Collection
{
    /**
     * @param $key
     * @return \Spatie\DataTransferObject\DataTransferObject|Model
     */
    public function offsetGet($key) : DataTransferObject| Model
    {
        return parent::offsetGet($key);
    }

    /**
     * @return array
     */
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

    /**
     * @return $this
     */
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