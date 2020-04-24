# Serwis Ogłoszeniowy (Laravel + Vue) - Hubert Sitarski

## 1. Uruchomienie projektu

1. Pobieramy projekt
2. W katalogu `backend` uruchamiamy `composer install`
3. Kopiujemy `env.example` do `.env` i uzupełniamy plik `.env` o dane bazy danych
4. Używamy komendy `php artisan migrate`
5. Uzywamy komendy `php artisan db:seed`
6. Uruchamiamy serwer komendą `php artisan serve`
6. Przechodzimy do katalogu `frontend`
7. Uruchamiamy `npm install`
8. Uruchamamy serwer komendą `npm run serve`
9. Pod adresami `127.0.0.1:8000` znajdziemy API, pod adresem `127.0.0.1:8080` znajdziemy warstwę front-endową

## 2. Omówienie

Przygotowałem prostą aplikację, która ma symulować serwis ogłoszeniowy. Projekt wydałem w formie MVP - dodałem podstawowe funkcje, które umożliwiają funkcjonowanie portalu.

Do dorobienia byłyby lepsze zabezpieczenia formularzy po stronie Vue i dorobienie paru funkcjonalności (np. wymiana wiadomości między użytkownikami, role) po stronie Laravela

W obecnej formie, możemy się zarejerstrować i zalogować jako administrator, przeglądać ogłoszenia, dodawać ogłoszenia, usuwać ogłoszenia i edytować ogłoszenia.

Jest to tylko szkic potencjalnej, większej aplikacji, ale myślę, że dobrze oddaje mój obecny stopien zaawansowania w Laravelu i Vue