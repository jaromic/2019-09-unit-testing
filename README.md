# Test-Driven Development (TDD): Getting Started
## Composer installieren
### Windows-User
1. Installiere [Composer](https://getcomposer.org/Composer-Setup.exe).
1. Beende PHPStorm und starte es neu.
### MacOS, Linux
1. [Command-Line installation](https://getcomposer.org/download/) ausführen ).
1. `PATH` configurieren
1. in neuem Terminal testen: `composer --help`
1. Beende PHPStorm und starte es neu.
## Abhängigkeiten installieren
Rufe Tools/Composer/Install auf.
## Datenbank erstellen
1. Gehe auf http://localhost/phpmyadmin und erstelle die Datenbank `2019-09-unit-testing` mit Zeichensatz `utf8mb4_general_ci`.
1. Kopiere folgende SQL-Befehle in das SQL-Fenster und führe sie aus:
```
CREATE USER '2019-09-unit-testing'@'localhost' IDENTIFIED BY '2019-09-unit-testing';
GRANT USAGE ON *.* TO '2019-09-unit-testing'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `2019-09-unit-testing`.* TO '2019-09-unit-testing'@'localhost'; 
```
