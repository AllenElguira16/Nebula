<?php

namespace Nebula\Routing;

// use Clusters\Attributes\{Get, Post};

class Route {
    /**
     * Stores matched route
     */
    private array $controller = [];

    private static ?Route $instance = null;

    /**
     * Instance of Route
     * implementing Singleton
     */
    public static function instance () {
        if (self::$instance === null) {
            self::$instance = new Route();
        }

        return self::$instance;
    }

    /**
     * Parse Controllers
     * 
     * @param string $directory root directory
     */
    public function parseControllers(string $directory): void {
        $controller = ControllerParser::parse($directory);
        $this->controller = $controller !== null ? $controller : [
            'name' => null,
            'method' => null
        ];
    }

    /**
     * Dispatch route to the endpoint
     * 
     * @param string $directory
     * @return string
     */
    public function dispatch($directory): string {
        return Dispatcher::dispatch($this->controller, $directory);
    }
}
