<?php

declare(strict_types=1);

// CORS Header setzen
header('Access-Control-Allow-Origin: *'); // Erlaubt allen Ursprüngen Zugriff, ändere das bei Bedarf auf spezifische URLs
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Falls der Entwicklungsmodus nicht aktiv ist, setze ihn auf development
if (getenv('APPLICATION_ENV') !== 'development') {
    putenv('APPLICATION_ENV=development');
}

// Error Reporting für Development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keeps the global namespace clean.
 */
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var \Mezzio\Application $app */
    $app = $container->get(\Mezzio\Application::class);
    $factory = $container->get(\Mezzio\MiddlewareFactory::class);

    // Execute programmatic/declarative middleware pipeline and routing
    // configuration statements
    (require 'config/pipeline.php')($app, $factory, $container);
    (require 'config/routes.php')($app, $factory, $container);

    $app->run();
})();
