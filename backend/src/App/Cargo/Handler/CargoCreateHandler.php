<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use App\Cargo\Controller\CargoController;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoCreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly CargoController $cargoController
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);

        // FUCHS:TODO: Testen und aktivieren
        // $success = $this->cargoController->create($data);
        $success = true;

        if (!$success) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Fehler beim Erstellen der Frachtdaten'
            ], 400);
        }
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Frachtdaten erfolgreich erstellt',
            'received_data' => $data
        ], 200);
    }
}
