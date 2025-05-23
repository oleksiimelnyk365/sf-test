<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\WeatherApiException;
use App\Service\WeatherService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Контролер для відображення погоди у вказаному місті.
 */
class WeatherController extends AbstractController
{
    /**
     * Відображає погоду для заданого міста.
     *
     * @param string $city Назва міста
     * @param WeatherService $weatherService Сервіс погоди
     * @param LoggerInterface $weatherLogger Логер
     * @return Response HTTP-відповідь з погодою або повідомленням про помилку
     */
    #[Route('/weather/{city}', name: 'weather_show')]
    public function show(string $city, WeatherService $weatherService, LoggerInterface $weatherLogger): Response
    {
        try {
            $weather = $weatherService->getWeather($city);
            $weatherLogger->info('Weather data received from ' . WeatherService::class . ' for city: ' . $city);

            return $this->render('//weather/show.html.twig', [
                'weather' => $weather,
            ]);
        } catch (WeatherApiException $e) {
            $weatherLogger->error(
                'ERROR from ' . WeatherService::class . ' for city: ' . $city,
                ['exception' => $e]
            );

            return new Response($e->getMessage(), 500);
        }
    }
}
