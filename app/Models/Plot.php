<?php

namespace App\Models;

use Database\Factories\PlotFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Plot
 *
 * @property string $cn
 * @property string $address
 * @property string $price
 * @property string $area
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static PlotFactory factory(...$parameters)
 * @method static Builder|Plot newModelQuery()
 * @method static Builder|Plot newQuery()
 * @method static Builder|Plot query()
 * @method static Builder|Plot whereAddress($value)
 * @method static Builder|Plot whereArea($value)
 * @method static Builder|Plot whereCn($value)
 * @method static Builder|Plot whereCreatedAt($value)
 * @method static Builder|Plot wherePrice($value)
 * @method static Builder|Plot whereUpdatedAt($value)
 * @property string $cadastral_number
 * @method static Builder|Plot whereCadastralNumber($value)
 * @mixin \Eloquent
 */
class Plot extends Model
{
    use HasFactory;

    protected $primaryKey = 'cadastral_number';

    public $incrementing = false;

    protected $fillable = [
        'cadastral_number',
        'area',
        'price',
        'address'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
