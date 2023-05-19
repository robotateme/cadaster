<?php

namespace App\Services;

use App\DTOs\PlotsFilterDto;
use App\DTOs\ApiPlotsListDto;
use App\Models\Plot;
use App\Repositories\Contracts\PlotsRepositoryInterface;
use App\Repositories\PlotsRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;


class PlotsService implements Contracts\PlotsServiceInterface
{
    /**
     * @param  PlotsRepository  $plotsRepository
     */
    public function __construct(private PlotsRepositoryInterface $plotsRepository)
    {

    }

    /**
     * @param  \App\DTOs\PlotsFilterDto  $plotsFilterData
     * @return array
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getPlotsList(PlotsFilterDto $plotsFilterData): array
    {
        $plots = $this->plotsRepository->getByCns($plotsFilterData)->get();
        $plotsResult = [];

        foreach ($plotsFilterData->cadastral_numbers as $k => $plotCn) {
            /** @var Plot $plot */
            $plot = $plots->firstWhere('cadastral_number', '=', $plotCn);
            if (!is_null($plot)) {
                if ($plot->updated_at->addHour() > Carbon::now()) {
                    unset($plotsFilterData->cadastral_numbers[$k]);
                    $plotsResult[] = $plot->only($plot->getFillable());
                }
            }
        }

        if (!empty($plotsFilterData->cadastral_numbers)) {
            $response = Http::acceptJson()->post('https://api.pkk.bigland.ru/test/plots',
                [
                    'collection' => [
                        'plots' => $plotsFilterData->cadastral_numbers
                    ]
                ]
            );

            $plotsData = new ApiPlotsListDto(plots: $response->json());
            $this->plotsRepository->syncPlots($plotsData);
            $plotsResult = array_merge($plotsResult, $plotsData->plots->toArray());
        }

        return $plotsResult;
    }
}