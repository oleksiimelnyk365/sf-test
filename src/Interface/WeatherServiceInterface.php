<?php

declare(strict_types=1);

namespace App\Interface;

use App\Exception\WeatherApiException;

/**
 * Інтерфейс для сервісу погоди.
 */
interface WeatherServiceInterface
{
    /**
     * Отримує погодні дані для міста.
     *
     * @param string $city
     * @return array
     * @throws WeatherApiException
     */
    public function getWeather(string $city): array;
}
