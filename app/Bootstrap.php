<?php

    declare(strict_types=1);

    namespace App;

    use Nette\Neon\Neon;
    use Nette\Configurator;


    class Bootstrap
    {
        public static function boot(): Configurator
        {
            $configurator = new Configurator;

            $configurator->setTimeZone('Europe/Prague');
            $configurator->setDebugMode(true);
            $configurator->addConfig(__DIR__ . '/config/common.neon');

            $configurator->enableTracy(__DIR__ . '/../log');
            $configurator->setTempDirectory(__DIR__ . '/../temp');

            $configurator->createRobotLoader()
                ->addDirectory(__DIR__)
                ->register();

            return $configurator;
        }
    }
