<?php

declare(strict_types=1);

namespace App\Cargo\Middleware;

use App\Cargo\Controller\CargoController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoCreateMiddleware implements MiddlewareInterface
{
    public function __construct(
        readonly CargoController $cargoController,
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $this->cargoController->create($data);

        return $handler->handle($request->withAttribute('create', $data));
    }
}
