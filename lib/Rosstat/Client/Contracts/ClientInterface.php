<?php

namespace Lib\Rosstat\Client\Contracts;

use Lib\Rosstat\Requests\Contracts\RequestInterface;
use Illuminate\Http\Client\Response;

interface ClientInterface
{
    public function sendRequest(RequestInterface $request): Response;

}