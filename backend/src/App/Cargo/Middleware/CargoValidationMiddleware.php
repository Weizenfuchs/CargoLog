<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoValidationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        
        // FUCHS:TODO Implement validation logic here
        // For now, we just pass the request to the handler

        return $handler->handle($request);
    }
}
