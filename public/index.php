<?php

// Підключення автозавантаження Composer
use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

/**
 * Точка входу у Symfony-додаток.
 * Ініціалізує ядро з переданим середовищем та режимом налагодження.
 */
return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
