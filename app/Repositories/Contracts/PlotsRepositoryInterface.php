<?php

namespace App\Repositories\Contracts;

use App\DTOs\ApiPlotsListDto;
use App\DTOs\PlotsFilterDto;
use Illuminate\Database\Eloquent\Builder;

interface PlotsRepositoryInterface extends RepositoryInterface
{
    public function getByCns(PlotsFilterDto $filterDto) : Builder;

    public function syncPlots(ApiPlotsListDto $plotsData) : bool;
}