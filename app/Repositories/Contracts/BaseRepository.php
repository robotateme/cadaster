<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }
}