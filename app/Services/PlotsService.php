<?php

namespace App\Services;

use App\DTOs\ApiPlotsListDto;
use App\DTOs\PlotsFilterDto;
use App\Models\Plot;
use App\Repositories\Contracts\PlotsRepositoryInterface;
use App\Repositories\PlotsRepository;
use Illuminate\Support\Carbon;
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
                if ($plot->updated_at->addHour() >= Carbon::now()) {
                    unset($plotsFilterData->cadastral_numbers[$k]);
                    $plotsResult[] = $plot->only($plot->getFillable());
                }
            }
        }

        if (!empty($plotsFilterData->cadastral_numbers)) {
            $request = new PlotsRequest($plotsFilterData->cadastral_numbers);
            $response = $this->apiClient->sendRequest($request);

            if ($response->ok()) {
                $plotsData = new ApiPlotsListDto(plots: $response->json());
                $this->plotsRepository->syncPlots($plotsData);
                $plotsResult = array_merge($plotsResult, $plotsData->plots->toArray());
            }
        }

        return $plotsResult;
    }
}