<?php
// tests/Service/WeatherServiceTest.php
namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Psr\Log\NullLogger;
use App\Service\WeatherService;

class WeatherServiceTest extends TestCase
{
    public function testGetWeatherReturnsData()
    {
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse->method('toArray')->willReturn([
            'location' => ['name' => 'London', 'country' => 'UK'],
            'current' => [
                'temp_c' => 15,
                'condition' => ['text' => 'Sunny'],
                'humidity' => 60,
                'wind_kph' => 12,
                'last_updated' => '2025-05-22 12:00'
            ]
        ]);

        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $mockHttpClient->method('request')->willReturn($mockResponse);

        $weatherService = new WeatherService($mockHttpClient, new NullLogger(), 'fake_api_key');
        $data = $weatherService->getWeather('London');

        $this->assertEquals('London', $data['city']);
        $this->assertEquals(15, $data['temperature']);
    }
}
