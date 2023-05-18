<?php

namespace App\Services;

use App\DTOs\PlotsListDto;
use App\Repositories\Contracts\PlotsRepositoryInterface;
use Illuminate\Support\Collection;
use App\Repositories\PlotsRepository;


class PlotsService implements Contracts\PlotsServiceInterface
{
    /**
     * @param  PlotsRepository  $plotsRepository
     */
    public function __construct(PlotsRepositoryInterface $plotsRepository)
    {

    }

    /**
     * @param  \App\DTOs\PlotsListDto  $data
     * @return array|\Illuminate\Support\Collection
     */
    public function getPlotsList(PlotsListDto $data): array|Collection
    {
        return [
            'data' => $data
        ];
    }

}