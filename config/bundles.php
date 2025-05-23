<?php

declare(strict_types=1);

/**
 * Реєстрація Symfony-бандлів для всіх середовищ.
 */
return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
];
