<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use App\Cargo\Controller\CargoController;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoListHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly CargoController $cargoController
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->cargoController->getAllCargo();
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Frachtdaten erfolgreich geladen',
            'data' => $data
        ], 200);
    }
}
