# CargoLog
PWA zur Protokollierung von Anlieferungen. Das Frontend basiert auf Angular 21. Das Backend wird via REST-API im Mezzio Framework mit PHP betrieben. Als Datenbank kommt eine Phinx versionierte Postgres-DB zum Einsatz.

# Projektanforderungen:

- WSL
  - PHP > 8.2
  - Composer
  - nodejs
  - npm

# Projektumgebung:

### WSL Installation:
`wsl --install`

---
# Frontend - Angular Setup (`cd ~/projects/CargoLog/frontend`):

### Abhängigkeiten installieren:
`npm install`

### Development Server starten:
`ng serve`

### Im Browser aufrufen:
`http://localhost:4200`

# Backend - Mezzio Setup (`cd ~/projects/CargoLog/backend`):

### Composer installieren:
`sudo apt-get install composer`

### Mezzio Framework Skeleton:
`composer require mezzio/mezzio-skeleton`

### CORS einrichten:
`composer require mezzio/mezzio-cors`

Die `Mezzio\Cors\Middleware\CorsMiddleware` wurde zur Pipeline hinzugefügt um das Setzen der CORS Header zu übernehmen.<br>
Die Konfigurationsdatei `cors.global.php` beschreibt welche Header und Origins erlaubt sind.<br>
Derzeit werden nur Anfragen des Angular Dev Servers `http://localhost:4200` entgegen genommen. Beim Produktivgang der Software muss dies angepasst werden.

### Backend starten:
`php -S localhost:8080 -t public/`

# Datenbank - Postgres Setup:

**Installation:**<br>
`sudo apt-get install postgresql postgresql-client`<br>
**Start:**<br>
`sudo service postgresql start`<br>
**Status:**<br>
`sudo service postgresql status`<br>
**Login:**<br>
`sudo -u postgres psql`

## PostgreSQL PHP Erweiterung installieren:
`sudo apt install php-pgsql`

TODO:

Die Architektur-Ebenen
1. Request → Domain Model (Hydration)
Hier kommt der Hydrator ins Spiel: Er verwandelt rohe Request-Daten in dein Domain Model (Cargo mit Value Objects).
2. Domain Model → Datenbank (Persistence)
Hier kommt der Extractor ins Spiel: Er verwandelt dein Domain Model in ein Format, das die Datenbank versteht.
3. Datenbank → Domain Model (Reconstruction)
Wieder Hydrator: Verwandelt DB-Daten zurück in dein Domain Model.
Deine Architektur sollte so aussehen:
Request (JSON)
    ↓
Middleware (SimpleCorsMiddleware)
    ↓
Middleware (ValidationMiddleware) ← validiert rohe Daten
    ↓
Handler/Controller
    ↓ nutzt Hydrator
Domain Model (Cargo mit Value Objects)
    ↓ gibt an Repository
Repository
    ↓ nutzt Extractor
Datenbank

---

## Konkrete Implementierung:

1. CargoHydrator (Request → Domain)

```php
<?php

declare(strict_types=1);

namespace App\Cargo\Hydrator;

use App\Cargo\Model\Cargo;
use App\Cargo\Model\ValueObjects\Amount;
use App\Cargo\Model\ValueObjects\CargoId;
use App\Cargo\Model\ValueObjects\Description;
use App\Cargo\Model\ValueObjects\OrderDate;
use App\Cargo\Model\ValueObjects\TransportType;
use App\Cargo\Model\ValueObjects\Weight;
use Ramsey\Uuid\Uuid;

class CargoHydrator
{
    /**
     * Erstellt ein neues Cargo aus Request-Daten
     */
    public function hydrateFromRequest(array $data): Cargo
    {
        return new Cargo(
            uuid: Uuid::uuid4(), // Neue UUID für neues Cargo
            cargoId: isset($data['cargoId']) ? new CargoId($data['cargoId']) : null,
            amount: new Amount($data['amount']),
            description: new Description($data['description']),
            weight: new Weight($data['weight']),
            orderDate: new OrderDate($data['orderDate']),
            transportType: new TransportType($data['transportType'])
        );
    }

    /**
     * Rekonstruiert Cargo aus Datenbank-Daten
     */
    public function hydrateFromDatabase(array $data): Cargo
    {
        return new Cargo(
            uuid: Uuid::fromString($data['uuid']),
            cargoId: isset($data['cargo_id']) ? new CargoId($data['cargo_id']) : null,
            amount: new Amount($data['amount']),
            description: new Description($data['description']),
            weight: new Weight($data['weight']),
            orderDate: new OrderDate($data['order_date']),
            transportType: new TransportType($data['transport_type'])
        );
    }
}
```

2. CargoExtractor (Domain → Datenbank)

```php
<?php

declare(strict_types=1);

namespace App\Cargo\Extractor;

use App\Cargo\Model\Cargo;

class CargoExtractor
{
    /**
     * Extrahiert Cargo zu Datenbank-Array
     */
    public function extract(Cargo $cargo): array
    {
        return [
            'uuid' => $cargo->uuid->toString(),
            'cargo_id' => $cargo->cargoId?->value(), // Annahme: Value Objects haben value() Methode
            'amount' => $cargo->amount->value(),
            'description' => $cargo->description->value(),
            'weight' => $cargo->weight->value(),
            'order_date' => $cargo->orderDate->value(),
            'transport_type' => $cargo->transportType->value(),
        ];
    }
}
```
3. CargoRepository (nutzt Extractor & Hydrator)

```php
<?php

declare(strict_types=1);

namespace App\Cargo\Repository;

use App\Cargo\Model\Cargo;
use App\Cargo\Hydrator\CargoHydrator;
use App\Cargo\Extractor\CargoExtractor;
use PDO;
use Ramsey\Uuid\UuidInterface;

class CargoRepository
{
    public function __construct(
        private PDO $pdo,
        private CargoHydrator $hydrator,
        private CargoExtractor $extractor
    ) {}

    public function save(Cargo $cargo): void
    {
        $data = $this->extractor->extract($cargo);
        
        $sql = 'INSERT INTO cargo (uuid, cargo_id, amount, description, weight, order_date, transport_type) 
                VALUES (:uuid, :cargo_id, :amount, :description, :weight, :order_date, :transport_type)';
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function findByUuid(UuidInterface $uuid): ?Cargo
    {
        $sql = 'SELECT * FROM cargo WHERE uuid = :uuid';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['uuid' => $uuid->toString()]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }
        
        return $this->hydrator->hydrateFromDatabase($data);
    }
}
```

4. CargoController (orchestriert alles)
```php
<?php

declare(strict_types=1);

namespace App\Cargo\Handler;

use App\Cargo\Hydrator\CargoHydrator;
use App\Cargo\Repository\CargoRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CargoCreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private CargoRepository $repository,
        private CargoHydrator $hydrator
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        
        // Validierte Daten → Domain Model
        $cargo = $this->hydrator->hydrateFromRequest($data);
        
        // Domain Model → Datenbank
        $this->repository->save($cargo);
        
        return new JsonResponse([
            'success' => true,
            'uuid' => $cargo->uuid->toString(),
            'message' => 'Cargo erfolgreich erstellt'
        ], 201);
    }
}
```

## Zur UUID-Frage:

**Die UUID sollte NIE null sein!** Sie ist dein eindeutiger Identifier. 

- **Bei neuem Cargo**: UUID wird im Hydrator generiert (`Uuid::uuid4()`)
- **Bei bestehendem Cargo**: UUID wird aus der DB gelesen und rekonstruiert
- **CargoId kann null sein**: Falls es eine optionale Business-ID ist (z.B. Kundennummer)

## Der Flow zusammengefasst:

POST /api/cargo mit JSON
    ↓
ValidationMiddleware (prüft Struktur)
    ↓
CargoCreateHandler
    ↓ nutzt CargoHydrator
Cargo Model (mit UUID, Value Objects)
    ↓ gibt an Repository
CargoRepository
    ↓ nutzt CargoExtractor
INSERT in Datenbank
Warum das Sinn macht:

Hydrator: Weiß, wie man aus primitiven Daten Value Objects baut
Extractor: Weiß, wie man aus Value Objects primitive Daten macht
Repository: Kennt nur die Datenbank-Logik, keine Business-Regeln
Controller: Orchestriert, delegiert aber alle Logik

Macht das Sinn für dich? Wo genau raucht der Kopf noch? 😊