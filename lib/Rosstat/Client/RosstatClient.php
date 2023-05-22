<?php

namespace Lib\Rosstat\Client;

use Illuminate\Http\Client\Response;
use Lib\Rosstat\Client\Contracts\ClientInterface;
use Lib\Rosstat\Requests\Contracts\RequestInterface;

class RosstatClient implements ClientInterface
{

    public function sendRequest(RequestInterface $request): Response
    {
        return $request->send();
    }
}