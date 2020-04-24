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
11. Pod adresami `127.0.0.1:8000` znajdziemy API, pod adresem `127.0.0.1:8080` znajdziemy warstwę front-endową
12. UWAGA! Należy wyłączyć AdBlocka, aby zapobiec błędom w pobieraniu danych z API

## 2. Omówienie

Przygotowałem prostą aplikację, która ma symulować serwis ogłoszeniowy. Projekt wydałem w formie MVP - dodałem podstawowe funkcje, które umożliwiają funkcjonowanie portalu.

Do dorobienia byłyby lepsze zabezpieczenia formularzy po stronie Vue i dorobienie paru funkcjonalności (np. wymiana wiadomości między użytkownikami, role, lepsza obsługa błędów po stronie frontu) po stronie Laravela

W obecnej formie, możemy się zarejerstrować i zalogować jako administrator, przeglądać ogłoszenia, dodawać ogłoszenia, usuwać ogłoszenia i edytować ogłoszenia.

Jest to tylko szkic potencjalnej, większej aplikacji, ale myślę, że dobrze oddaje mój obecny stopien zaawansowania w Laravelu i Vue