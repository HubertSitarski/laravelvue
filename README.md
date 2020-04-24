# Serwis Ogłoszeniowy (Laravel + Vue) - Hubert Sitarski

## 1. Uruchomienie projektu

1. Pobieramy projekt
2. W katalogu `backend` uruchamiamy `composer install`
3. Kopiujemy `env.example` do `.env` i uzupełniamy plik `.env` o dane bazy danych
4. Używamy komendy `php artisan migrate`
5. Uruchamiamy komendę `php artisan passport:install`
6. Uzywamy komendy `php artisan db:seed`
7. Uruchamiamy serwer komendą `php artisan serve`
8. Przechodzimy do katalogu `frontend`
9. Uruchamiamy `npm install`
10. Uruchamamy serwer komendą `npm run serve`
11. Pod adresem `127.0.0.1:8000` znajdziemy API, pod adresem `127.0.0.1:8080` znajdziemy warstwę front-endową
12. UWAGA! Należy wyłączyć AdBlocka, aby zapobiec błędom w pobieraniu danych z API
13. W przypadku wykonywania testów należy użyć komendy `./vendor/bin/phpunit` lub `php artisan test (Laravel 7)`

## 2. Omówienie

Przygotowałem prostą aplikację, która ma symulować serwis ogłoszeniowy. Projekt wydałem w formie MVP - dodałem podstawowe funkcje, które umożliwiają funkcjonowanie portalu.

Do dorobienia byłyby lepsze zabezpieczenia formularzy po stronie Vue i dorobienie paru funkcjonalności (np. wymiana wiadomości między użytkownikami, role, lepsza obsługa błędów po stronie frontu) po stronie Laravela

W obecnej formie, możemy się zarejerstrować i zalogować jako administrator, przeglądać ogłoszenia, dodawać ogłoszenia, usuwać ogłoszenia i edytować ogłoszenia.

Jest to tylko szkic potencjalnej, większej aplikacji, ale myślę, że dobrze oddaje mój obecny stopien zaawansowania w Laravelu i Vue

## 3. TODO

* Użycie Eloquent: API Resources do mapowania JSONów w przypadku wystąpienia bardziej skomplikowanych danych niż obecnie
* Dodanie dodatkowych funkcjonalności (upload plików, wiadomości między użytkownikami, obsługa ról)
* Lepsza obsługa błędów
* Większe pokrycie kodu testami
* Dodatkowe walidacje formularzy po stronie Vue.js

## 4. Wybrane, użyte narzedzia

* Laravel 6
* MySQL
* Laravel Passport
* PHP Unit
* Vue.js + Vue CLI
* Vuex
* Vue Router
* Bootstrap 4
* Axios
* Localforage