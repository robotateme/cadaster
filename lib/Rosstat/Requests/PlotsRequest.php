<?php

namespace Lib\Rosstat\Requests;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Lib\Rosstat\Requests\Contracts\RequestInterface;

class PlotsRequest implements RequestInterface
{
    const URL = '/test/plots';

    private string $url = '';

    /**
     * @param  array  $data
     */
    public function __construct(private array $data = []) {
        $this->url = config('app.rosstat_url') . static::URL;
    }

    public function send(): PromiseInterface|Response
    {
        return Http::acceptJson()->post($this->url,
            [
                'collection' => [
                    'plots' => $this->data
                ]
            ]
        );
    }
}