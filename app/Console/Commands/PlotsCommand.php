<?php

namespace App\Console\Commands;

use App\DTOs\PlotsFilterDto;
use App\Services\PlotsService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class PlotsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plots:get {cadastral_numbers*}';

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
    public function handle(PlotsService $plotsService, Model $plotModel): int
    {

        $cadastral_numbers = array_map(function ($item) {
            return preg_replace(['/[,\s]/'], '', $item);
        }, $this->argument('cadastral_numbers'));

        $plotsData = $plotsService->getPlotsList(
            new PlotsFilterDto(cadastral_numbers: $cadastral_numbers)
        );

        $this->table($plotModel->getFillable(), $plotsData);

        return 0;
    }
}
