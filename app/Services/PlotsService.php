<?php

namespace App\Services;

use App\DTOs\ApiPlotsListDto;
use App\DTOs\PlotsFilterDto;
use App\Models\Plot;
use App\Repositories\Contracts\PlotsRepositoryInterface;
use App\Repositories\PlotsRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Lib\Rosstat\Client\Contracts\ClientInterface;
use Lib\Rosstat\Requests\PlotsRequest;


class PlotsService implements Contracts\PlotsServiceInterface
{
    /**
     * @param  PlotsRepository  $plotsRepository
     */
    public function __construct(private PlotsRepositoryInterface $plotsRepository, private ClientInterface $apiClient)
    {

    }

    /**
     * @param  \App\DTOs\PlotsFilterDto  $plotsFilterData
     * @return array|\Illuminate\Support\Collection
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getPlotsList(PlotsFilterDto $plotsFilterData): array | Collection
    {
        $plots = $this->plotsRepository->getByCns($plotsFilterData)->get();
        $plotsResult = [];

        foreach ($plotsFilterData->cadastral_numbers as $k => $plotCn) {
            /** @var Plot $plot */
            $plot = $plots->firstWhere('cadastral_number', '=', $plotCn);
            if (!is_null($plot)) {
                if ($plot->updated_at->addHour() >= Carbon::now()) {
                    unset($plotsFilterData->cadastral_numbers[$k]);
                    $plotsResult[] = $plot;
                }
            }
        }

        if (!empty($plotsFilterData->cadastral_numbers)) {
            $request = new PlotsRequest($plotsFilterData->cadastral_numbers);
            $response = $this->apiClient->sendRequest($request);

            if ($response->ok()) {
                $plotsData = new ApiPlotsListDto(plots: $response->json());
                $this->plotsRepository->syncPlots($plotsData);
                $plotsResult = $plotsData->plots->toModels(Plot::class)->merge($plotsResult);
            }
        }

        return collect($plotsResult);
    }
}