<?php

namespace App\Repositories;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class PlotsRepository implements Contracts\PlotsRepositoryInterface
{

    public function __construct(private Model $model)
    {

    }

    /**
     * @param  array  $cns
     * @return \Illuminate\Database\Query\Builder
     */
    public function getByCns(array $cns) : Builder
    {
        return DB::table($this->model->getTable())
            ;
    }

    /**
     * @param  \App\DTOs\PlotsApiResult[]  $data
     * @return \Illuminate\Database\Query\Builder
     */
    public function syncPlots(array $data) : Builder
    {
        return DB::table($this->model->getTable())
            ;
    }
}