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

Як уже було сказано вище - використанео докер скелетон https://github.com/dunglas/symfony-docker - процес установкеи описаний там

в цілому можна зробити ось так:

1. Створи .env.local
2. Відреедагуй змінні за необхідності (HTTP_PORT і т.д) 
3. Встанови змінну WEATHER_API_KEY (тестовий ключ cdd3c97cda9045dba03100717251806). Отримати новий ключ тут: https://www.weatherapi.com/my/
4. Виконай команди докер:
```bash
docker compose build --pull --no-cache to build fresh images
docker compose up --wait to set up and start a fresh Symfony project
```
5.Відкрий  https://localhost{HTTPS_PORT}

Наприклад: https://localhost:4433/weather/Lviv

Готово! 


## ✅ Тестування

```bash
php bin/phpunit
```

## 🧑‍💻 Автор

Цей проєкт реалізовано як тестове завдання для Symfony-розробника.
