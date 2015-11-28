<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RestAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $tokenHeader = $request->getHeader('X-Auth-Token');
        if (count($tokenHeader) > 0) {
            $tokenHeaderValue = $tokenHeader[0];
        } else {
            $tokenHeaderValue = null;
        }

        $data = array(
            'requestMethod' => $request->getMethod(),
            'requestUri' => $request->getRequestTarget(),
            'queryParams' => $request->getQueryParams(),
            'formParams' => $request->getParsedBody(),
            'rawBody' => (string)$request->getBody(),
            'headers' => $request->getHeaders(),
            'X-Auth-Token' => $tokenHeaderValue,
        );
        return new JsonResponse($data);
    }
}
