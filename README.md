### This functionality implemented with Docker and used docker template mentioned in Symfony Docs
### More details there:
https://symfony.com/doc/current/setup/docker.html
https://github.com/dunglas/symfony-docker

# Symfony Weather App

Цей проєкт — простий додаток на Symfony 6.4, який отримує та відображає поточну погоду у вказаному місті за допомогою зовнішнього API (https://weatherapi.com).

## 📦 Технології

- PHP 8.2
- Symfony 6.4
- Twig (шаблонізатор)
- HttpClient (Symfony компонент)
- Monolog (логування)
- PHPUnit (тестування)

## 📁 Структура

- `src/Controller/` — контролери (вивід погодних даних)
- `src/Service/` — сервіс для запитів до API
- `src/Exception/` — кастомні винятки
- `src/Interface/` — інтерфейс сервісу погоди
- `tests/` — юніт-тести
- `config/` — конфігурація бандлів і контейнера
- `public/` — точка входу (`index.php`)

## ⚙️ Встановлення

```bash
git clone <репозиторій>
cd project-directory
composer install
```

## 🔐 Секрети

Створи файл `.env.local` і додай API-ключ:

```
WEATHER_API_KEY=your_weatherapi_key_here
```

## 🚀 Запуск

```bash
symfony server:start
```

Відкрий у браузері:
```
http://localhost:8000/weather/Lviv
```

## ✅ Тестування

```bash
php bin/phpunit
```

## 🧑‍💻 Автор

Цей проєкт реалізовано як тестове завдання для Symfony-розробника.
