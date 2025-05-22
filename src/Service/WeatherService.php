<?php
// src/Service/WeatherService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;
use App\Exception\WeatherApiException;

class WeatherService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface     $logger,
        private string              $apiKey
    )
    {
    }

    public function getWeather(string $city): array
    {
        $url = 'https://api.weatherapi.com/v1/current.json';

        try {
            $response = $this->httpClient->request('GET', $url, [
                'query' => [
                    'key' => $this->apiKey,
                    'q' => $city
                ]
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

        } catch (\Exception $e) {
            $this->logger->error("Error fetching weather data: " . $e->getMessage());
            throw new WeatherApiException("Не вдалося отримати дані погоди для міста: {$city}");
        }
    }
}
