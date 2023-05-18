<?php

namespace App\Console\Commands;

use App\Services\PlotsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
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
     * @return int
     */
    #[NoReturn] public function handle(PlotsService $plotsService): int
    {
        $response = Http::acceptJson()->post('https://api.pkk.bigland.ru/test/plots',
            [
                'collection' => [
                    'plots' => [
                        '69:27:0000022:1306',
                        '69:27:0000022:1307'
                    ]
                ]
            ]
        );
        dd($response->json());
    }
}
