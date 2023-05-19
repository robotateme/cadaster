<?php

namespace App\Http\Controllers;

use App\DTOs\PlotsFilterDto;
use App\Http\Requests\PlotsListRequest;
use App\Services\Contracts\PlotsServiceInterface;
use App\Services\Contracts\ServiceInterface;
use App\Services\PlotsService;

class PlotsController extends Controller
{
    /**
     * @param PlotsService $plotsService
     */
    public function __construct(private PlotsServiceInterface $plotsService)
    {
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function index(PlotsListRequest $request): array
    {
        return [
            $this->plotsService->getPlotsList(new PlotsFilterDto(...$request->validated())),
        ];
    }
}
