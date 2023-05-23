<?php

namespace Tests\Unit;

use App\DTOs\PlotsFilterDto;
use App\Models\Plot;
use App\Services\Contracts\ServiceInterface;
use App\Services\PlotsService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PlotsServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected ServiceInterface $plotsService;

    protected array $apiResponsePlotAttrs = [
        0 => [
            "id" => "test:api:id",
            "number" => "69:27:0000022:1306",
            "attrs" => [
                "plot_id" => "69:27:22:1306",
                "plot_area" => 10035,
                "plot_price" => 36126,
                "plot_number" => "test:api:id",
                "plot_address" => 'Тверская область, р-н Ржевский, с/пос "Успенское", северо-западнее д. Горшково из земель СПКколхоз "Мирный"',
                "category_code" => "003001000000",
                "category_name" => "Земли сельскохозяйственного назначения",
                "plot_area_inaccuracy" => 877,
                "permitted_use_document_name" => "Для ведения сельского хозяйства",
                "permitted_use_classifier_code" => null,
                "permitted_use_classifier_name" => null,
            ],
            "extent" => [
                "srs" => "EPSG:4326",
                "xmax" => 34.449952796012,
                "xmin" => 34.447128341683,
                "ymax" => 56.240833833255,
                "ymin" => 56.239494097315,
                "width" => 0.0028244543283193,
                "height" => 0.0013397359402632,
            ],
            "center" => [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        0 => 34.448540568847,
                        1 => 56.240163965285,
                    ]
                ],
                "crs" => [
                    "type" => "name",
                    "properties" => [
                        "name" => "urn:ogc:def:crs:OGC:1.3:CRS84"
                    ]
                ]
            ],
            "spatial" => [
                "type" => "Feature",
                "geometry" => [
                    "type" => "MultiPolygon",
                    "coordinates" => [
                        0 => [
                            0 => [
                                0 => [
                                    0 => 34.447128341683,
                                    1 => 56.239718149068,
                                ],
                                1 => [
                                    0 => 34.44733979958,
                                    1 => 56.240058075324
                                ],
                                2 => [
                                    0 => 34.447995673621,
                                    1 => 56.240036980582,
                                ],
                                3 => [
                                    0 => 34.448626800625,
                                    1 => 56.239904843105,
                                ],
                                4 => [
                                    0 => 34.449064512325,
                                    1 => 56.239983229707,
                                ],
                                5 => [
                                    0 => 34.449241939342,
                                    1 => 56.240443490258,
                                ],
                                6 => [
                                    0 => 34.449414480731,
                                    1 => 56.240833833255,
                                ],
                                7 => [
                                    0 => 34.449952796012,
                                    1 => 56.240818391902,
                                ],
                                8 => [
                                    0 => 34.449559130043,
                                    1 => 56.239494097315,
                                ]
                            ]
                        ]
                    ]
                ],
                "crs" => [
                    "type" => "name",
                    "properties" => [
                        "name" => "urn:ogc:def:crs:OGC:1.3:CRS84"
                    ]
                ]
            ],
            "created_at" => "2021-02-01T17:16:47+03:00",
            "updated_at" => "2022-12-26T21:09:14+03:00",
            "_links" => [
                "pkk" => [
                    "attrs" => [
                        "href" => null
                    ],
                    "search" => [
                        "href" => null,
                    ],
                    "related" => [
                        "href" => null,
                    ]
                ]
            ]
        ],
        1 => [
            "id" => "test:db:id",
            "number" => "69:27:0000022:1307",
            "attrs" => [
                "plot_id" => "69:27:22:1307",
                "plot_area" => 10176.00,
                "plot_price" => 36633.60,
                "plot_number" => "test:db:id",
                "plot_address" => 'Тверская область, р-н Ржевский, с/пос "Успенское", северо-западнее д. Горшково из земель СПКколхоз "Мирный"',
                "category_code" => "003001000000",
                "category_name" => "Земли сельскохозяйственного назначения",
                "plot_area_inaccuracy" => 877,
                "permitted_use_document_name" => "Для ведения сельского хозяйства",
                "permitted_use_classifier_code" => null,
                "permitted_use_classifier_name" => null,
            ],
            "extent" => [
                "srs" => "EPSG:4326",
                "xmax" => 34.449952796012,
                "xmin" => 34.447128341683,
                "ymax" => 56.240833833255,
                "ymin" => 56.239494097315,
                "width" => 0.0028244543283193,
                "height" => 0.0013397359402632,
            ],
            "center" => [
                "type" => "Feature",
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        0 => 34.448540568847,
                        1 => 56.240163965285,
                    ]
                ],
                "crs" => [
                    "type" => "name",
                    "properties" => [
                        "name" => "urn:ogc:def:crs:OGC:1.3:CRS84"
                    ]
                ]
            ],
            "spatial" => [
                "type" => "Feature",
                "geometry" => [
                    "type" => "MultiPolygon",
                    "coordinates" => [
                        0 => [
                            0 => [
                                0 => [
                                    0 => 34.447128341683,
                                    1 => 56.239718149068,
                                ],
                                1 => [
                                    0 => 34.44733979958,
                                    1 => 56.240058075324
                                ],
                                2 => [
                                    0 => 34.447995673621,
                                    1 => 56.240036980582,
                                ],
                                3 => [
                                    0 => 34.448626800625,
                                    1 => 56.239904843105,
                                ],
                                4 => [
                                    0 => 34.449064512325,
                                    1 => 56.239983229707,
                                ],
                                5 => [
                                    0 => 34.449241939342,
                                    1 => 56.240443490258,
                                ],
                                6 => [
                                    0 => 34.449414480731,
                                    1 => 56.240833833255,
                                ],
                                7 => [
                                    0 => 34.449952796012,
                                    1 => 56.240818391902,
                                ],
                                8 => [
                                    0 => 34.449559130043,
                                    1 => 56.239494097315,
                                ]
                            ]
                        ]
                    ]
                ],
                "crs" => [
                    "type" => "name",
                    "properties" => [
                        "name" => "urn:ogc:def:crs:OGC:1.3:CRS84"
                    ]
                ]
            ],
            "created_at" => "2021-02-01T17:16:47+03:00",
            "updated_at" => "2022-12-26T21:09:14+03:00",
            "_links" => [
                "pkk" => [
                    "attrs" => [
                        "href" => null
                    ],
                    "search" => [
                        "href" => null,
                    ],
                    "related" => [
                        "href" => null,
                    ]
                ]
            ]
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->plotsService = $this->app->make(PlotsService::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function test_api_data_save(): void
    {
        Http::fake([
            config('app.rosstat_url').'/*' => Http::response($this->apiResponsePlotAttrs)
        ]);

        $this->plotsService->getPlotsList(new PlotsFilterDto(cadastral_numbers: [1, 2]));
        $this->assertDatabaseHas('plots', ['cadastral_number' => 'test:api:id']);
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function test_db_data_sync_return(): void
    {
        Http::fake([
            config('app.rosstat_url').'/*' => Http::response($this->apiResponsePlotAttrs)
        ]);

        /** @var Plot $plotDb */
        $plotDb = Plot::factory()->create(
            [
                'cadastral_number' => 'test:db:id',
                'updated_at' => Carbon::now()->subHours(2)
            ]
        );


        $plots = $this->plotsService->getPlotsList(
            new PlotsFilterDto(cadastral_numbers: ['test:db:id', 'test:api:id'])
        );

        $this->assertDatabaseHas('plots', ['cadastral_number' => 'test:api:id']);
        $this->assertDatabaseHas('plots', ['cadastral_number' => 'test:db:id']);
        $newDbPlot = collect($plots)->firstWhere('cadastral_number', 'test:db:id');

        $this->assertTrue($plotDb->updated_at->diff($newDbPlot['updated_at'])->h == 2);
    }
}
