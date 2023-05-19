<?php

namespace App\Console\Commands;

use App\DTOs\PlotsFilterDto;
use App\Services\PlotsService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\NoReturn;

class PlotsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plots:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Services\PlotsService  $plotsService
     * @param  \Illuminate\Database\Eloquent\Model  $plotModel
     * @return int
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    #[NoReturn] public function handle(PlotsService $plotsService, Model $plotModel): int
    {
        $plotsData = $plotsService->getPlotsList(new PlotsFilterDto(cns: '69:27:0000022:1306, 69:27:0000022:1307'));
        $this->table($plotModel->getFillable(), $plotsData);
        return 0;
    }
}
