<?php

namespace App\Http\Controllers;

use App\DTOs\PlotsListDto;
use App\Http\Requests\PlotsListRequest;
use App\Services\Contracts\ServiceInterface;
use App\Services\PlotsService;

class PlotController extends Controller
{
    /**
     * @param PlotsService $plotsService
     */
    public function __construct(private ServiceInterface $plotsService)
    {
    }

    /**
     * @throws \WendellAdriel\ValidatedDTO\Exceptions\CastTargetException
     * @throws \WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException
     */
    public function index(PlotsListRequest $request): array
    {
        return [
            $this->plotsService->getPlotsList(PlotsListDto::fromArray($request->validated())),
        ];
    }
}
