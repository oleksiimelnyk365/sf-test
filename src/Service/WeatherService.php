<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\WeatherApiException;
use App\Interface\WeatherServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Сервіс для отримання погодних даних з зовнішнього API.
 */
class WeatherService implements WeatherServiceInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger,
        private string $apiKey
    ) {
    }

    /**
     * Отримує дані погоди для вказаного міста.
     *
     * @param string $city Назва міста
     * @return array{
     *     city: string,
     *     country: string,
     *     temperature: float,
     *     condition: string,
     *     humidity: int,
     *     wind_speed: float,
     *     last_updated: string
     * }
     * @throws WeatherApiException У разі помилки запиту
     */
    public function getWeather(string $city): array
    {
        $url = 'https://api.weatherapi.com/v1/current.json';

        try {
            $response = $this->httpClient->request('GET', $url, [
                'query' => [
                    'key' => $this->apiKey,
                    'q' => $city,
                ],
            ]);

            $data = $response->toArray();

            $this->logger->info("Weather data retrieved for {$city}");

            return [
                'city' => $data['location']['name'],
                'country' => $data['location']['country'],
                'temperature' => $data['current']['temp_c'],
                'condition' => $data['current']['condition']['text'],
                'humidity' => $data['current']['humidity'],
                'wind_speed' => $data['current']['wind_kph'],
                'last_updated' => $data['current']['last_updated'],
            ];
        } catch (\Throwable $e) {
            $this->logger->error("Error fetching weather data: " . $e->getMessage());
            throw new WeatherApiException("Не вдалося отримати дані погоди для міста: {$city}");
        }
    }
}
