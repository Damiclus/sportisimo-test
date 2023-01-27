<?php

    declare(strict_types=1);

    namespace app\router;

    use Nette;
    use Nette\Application\Routers\RouteList;


    final class RouterFactory
    {
        use Nette\StaticClass;

        public static function createRouter(): RouteList {
            $router = new RouteList;

            // Front
            $router->addRoute("/", [
                "module"    => "front",
                "presenter" => "Homepage",
                "action"    => "default"
            ]);
            // Admin
            $router->addRoute("admin[/<presenter>][/<action>][/<id>]", [
                "module"    => "admin",
                "presenter" => "Dashboard",
                "action"    => "default"
            ]);

            return $router;
        }
    }