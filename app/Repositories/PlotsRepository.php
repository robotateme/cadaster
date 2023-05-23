<?php

namespace App\Repositories;

use App\DTOs\PlotsFilterDto;
use App\DTOs\ApiPlotsListDto;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PlotsRepository extends BaseRepository implements Contracts\PlotsRepositoryInterface
{
    /**
     * @param  \App\DTOs\PlotsFilterDto  $filterDto
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getByCns(PlotsFilterDto $filterDto) : Builder
    {
        return $this->model->newQuery()
            ->whereIn('cadastral_number', $filterDto->cadastral_numbers)
            ;
    }

    /**
     * @param  \App\DTOs\ApiPlotsListDto  $plotsData
     * @return bool
     */
    public function syncPlots(ApiPlotsListDto $plotsData) : bool
    {
        $result = $this->model->newQuery()
            ->upsert($plotsData->plots->toArray(), 'cn', $this->model->getFillable());

        return $result === count($plotsData->plots);
    }
}