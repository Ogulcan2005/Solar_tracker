# Solar Tracker - Docker

## Starten

Open een terminal in de map `Solar_Tracker` en voer uit:

```bash
docker compose up -d --build
```

De applicatie is daarna beschikbaar op:

http://localhost:8081/solar

## Eerste keer

Als de container draait:

```bash
docker compose exec solar_tracker composer install
docker compose exec solar_tracker php artisan migrate
docker compose exec solar_tracker php artisan db:seed --class=SolarMeasurementSeeder
```

De projectmap wordt als volume in de container gemount. Apache draait als `www-data`, terwijl bestanden op je pc vaak alleen door jouw gebruiker schrijfbaar zijn. Zonder schrijfrechten op `storage/` en `database/database.sqlite` geeft Laravel een **500-fout** (lege pagina of Symfony-foutscherm). Bij elke containerstart zet het entrypoint-script de benodigde rechten automatisch goed.

Open de app op **http://localhost:8081/** of **http://localhost:8081/solar** (niet alleen poort 8081 zonder pad, tenzij je `/` gebruikt).

De database is SQLite en staat in:

```text
database/database.sqlite
```

## Controleren

Bekijk de containers:

```bash
docker compose ps
```

Bekijk Laravel/Apache logs:

```bash
docker compose logs -f solar_tracker
```

Stoppen:

```bash
docker compose down
```

## Poort aanpassen

Poort `8080` was in de oorspronkelijke omgeving al in gebruik. Daarom gebruikt deze Docker-opzet standaard `8081`.

Wil je toch `8080` gebruiken, start dan:

```bash
DOCKER_PORT=8080 docker compose up -d --build
```

Op Windows PowerShell:

```powershell
$env:DOCKER_PORT=8080
docker compose up -d --build
```
