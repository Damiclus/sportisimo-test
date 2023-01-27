<?php
    declare(strict_types=1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);

    require __DIR__ . '/../vendor/autoload.php';

    App\Bootstrap::boot()
        ->createContainer()
        ->getByType(Nette\Application\Application::class)
        ->run();
