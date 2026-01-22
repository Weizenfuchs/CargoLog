# CargoLog
PWA zur Protokollierung von Anlieferungen. Das Frontend basiert auf Angular 21. Das Backend wird via REST-API im Mezzio Framework mit PHP betrieben. Als Datenbank kommt eine Phinx versionierte Postgres-DB zum Einsatz.

# Die Architektur-Ebenen:

1. **Request → Domain Model (Hydration)**<br>
Der Hydrator verwandelt rohe Request-Daten in das Domain Model (Cargo mit Value Objects).
2. **Domain Model → Datenbank (Persistence)**<br>
Der Extractor verwandelt das Domain Model in ein Format, das die Datenbank versteht.
3. **Datenbank → Domain Model (Reconstruction)**<br>
Der Hydrator verwandelt die DB-Daten zurück in das Domain Model.
<br>

```
Request (JSON)
    ↓
CorsMiddleware via Pipeline
    ↓
ValidationMiddleware ← validiert rohe Daten
    ↓
Handler ← Controller ← nutzt Hydrator
    ↓
Domain Model (Cargo mit Value Objects)
    ↓ gibt an Repository
Repository
    ↓ nutzt Extractor
Datenbank
```

### Konkrete Implementierung:

1. **CargoHydrator:** Request → Domain
2. **CargoExtractor:** Domain → Datenbank
3. **CargoRepository:** Nutzt Extractor & Hydrator
4. **CargoController:** Orchestriert alles

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
