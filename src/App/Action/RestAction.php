<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\UploadedFile;
use \Codeception\Util\ReflectionHelper;

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
            'files' => $this->filesToArray($request->getUploadedFiles()),
        );
        return new JsonResponse($data);
    }

    private function filesToArray(array $files)
    {
        $result = [];
        foreach ($files as $fieldName => $uploadedFile) {
            /**
             * @var $uploadedFile UploadedFile|array
             */
            if (is_array($uploadedFile)) {
                $result[$fieldName] = $this->filesToArray($uploadedFile);
            } else {
                $result[$fieldName] = [
                    'name' => $uploadedFile->getClientFilename(),
                    'tmp_name' => ReflectionHelper::readPrivateProperty($uploadedFile, 'file'),
                    'size' => $uploadedFile->getSize(),
                    'type' => $uploadedFile->getClientMediaType(),
                    'error' => $uploadedFile->getError(),
                ];
            }
        }
        return $result;
    }
}
