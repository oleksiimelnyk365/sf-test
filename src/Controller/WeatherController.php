<?php
namespace App\Controller;

use App\Exception\WeatherApiException;
use App\Service\WeatherService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * WeatherController
 */
class WeatherController extends AbstractController
{
    #[Route('/weather/{city}', name: 'weather_show')]
    public function show(string $city, WeatherService $weatherService, LoggerInterface $weatherLogger): Response
    {
        try {
            $weather = $weatherService->getWeather($city);
            $weatherLogger->info("Weather data received from ".WeatherService::class . " city: " . $city);
            return $this->render('//weather/show.html.twig', ['weather' => $weather]);
        } catch (WeatherApiException $e) {
            $weatherLogger->error("ERROR from ".WeatherService::class . " city: " . $city,[$e]);
            return new Response($e->getMessage(), 500);
        }
    }
}
