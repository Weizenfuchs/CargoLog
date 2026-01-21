<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        
        if (!$data) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Keine Daten empfangen'
            ], 400);
        }
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Daten erfolgreich empfangen',
            'received_data' => $data
        ], 200);
    }
}
