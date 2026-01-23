# CargoLog
PWA zur Protokollierung von Anlieferungen. Das Frontend basiert auf Angular 21. Das Backend wird via REST-API im Laminas Mezzio Framework mit PHP 8.2 betrieben. Als Datenbank kommt eine Phinx versionierte MariaDB zum Einsatz.

Die Architektur folgt den Richtlinien des Domain-Driven Designs (DDD) und gliedert sich in Model und Controller auf um die Geschäftslogik (Model) von von der Anwendungssteuerung (Controller) zu trennen. Zur Persistierung der Daten wird ein hochgradig entkoppelter Ansatz verwendet, der  auf den Prinzipien von Hydration -> Persistence -> Reconstruction basiert.

Die `Mezzio\Cors\Middleware\CorsMiddleware` wurde zur Pipeline hinzugefügt um das Setzen der CORS Header zu übernehmen.<br>
Die Konfigurationsdatei `cors.global.php` beschreibt welche Header und Origins erlaubt sind.<br>
Derzeit werden nur Anfragen des Angular Dev Servers `http://localhost:4200` entgegen genommen. Beim Produktivgang der Software muss dies angepasst werden.

# Die Architektur-Ebenen:

1. **Hydration** (Request → Domain Model)<br>
Der Hydrator verwandelt rohe Request-Daten in das Domain Model (Cargo mit Value Objects).
2. **Persistence** (Domain Model → Datenbank)<br>
Der Extractor verwandelt das Domain Model in ein Format, das die Datenbank versteht.
3. **Reconstruction** (Datenbank → Domain Model)<br>
Der Hydrator verwandelt die DB-Daten zurück in das Domain Model.
<br>

### Datenfluss:
```
Request (JSON)
    ↓
CorsMiddleware via Pipeline ← nutzt cors.global.php für Zugriffskontrolle
    ↓
ValidationMiddleware ← validiert rohe Daten (Muss noch implementiert werden)
    ↓
Handler ← nutzt den Controller zur Persistierung und erstellt die Response
    ↓
Controller ← nutzt Hydrator um das Domain Model zu erstellen
    ↓
Domain Model (Cargo mit Value Objects)
    ↓
Repository ← nutzt Extractor um das Value Object für die Datenbank zu übersetzen
    ↓
Datenbank
```

### Konkrete Implementierung:

1. **CargoHydrator:** Request → Domain
2. **CargoExtractor:** Domain → Datenbank
3. **CargoRepository:** Nutzt Extractor und Hydrator
4. **CargoController:** Orchestriert das Repository

# Projektanforderungen:

- WSL
  - PHP > 8.2
  - Composer
  - nodejs
  - npm

# Projektumgebung:

### WSL Installation:
`wsl --install`

# Frontend - Angular Setup
`cd ~/projects/CargoLog/frontend`

### Abhängigkeiten installieren:
`npm install`

### Development Server starten:
`ng serve`

### Im Browser aufrufen:
`http://localhost:4200`

# Backend - Mezzio Setup 
`cd ~/projects/CargoLog/backend`

### Composer installieren:
`sudo apt-get install composer`

### Installieren der Projektabhängigkeiten:
`composer install`

### Backend starten:
`php -S localhost:8080 -t public/`

# Datenbank - MariaDB Setup:

**Installation:**<br>
`sudo apt-get install mariadb-server`<br>
**Start:**<br>
`sudo service mariadb start`<br>
**Status:**<br>
`sudo service mariadb status`<br>
**Automatisch beim Start von WSL Starten:**(ungetestet)<br>
`sudo systemctl enable mariadb`<br>
**Login:**<br>
`sudo mysql -u root -p`

### Erstellen der Datenbank "cargolog":
Um die Datenbank benutzen zu können, muss ein eigener Benutzer angelegt werden.
```sql
/* sudo mysql -u root -p */
CREATE DATABASE cargolog;
USE mysql;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'start123';
GRANT ALL PRIVILEGES ON cargolog.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
SELECT user, host FROM user;
```

### Erstellen der cargo Tabelle:

## Phinx (`cd ~/projects/CargoLog/backend`):

**Erstellen der Phinx Konfigurationsdatei:**
`php vendor/bin/phinx init`<br>
Verbindungsinformationen müssen in die hier erstellte phinx.php eingetragen werden.

**Erstellen einer Tabellenmigrationsdatei:**
`php vendor/bin/phinx create CreateCargo`

**Ausführen der Phinx Migrationen:**
`php vendor/bin/phinx migrate`

# Sonstiges:

### Prüfen der Daten in der Tabelle "cargo" in der Datenbank "cargolog":
```sql
/* sudo mysql -u root -p */
USE cargolog;
SELECT * FROM cargo;
```

### Error Logging Example:
```php
error_log('Informative Text: ' . print_r($data, true));
```
