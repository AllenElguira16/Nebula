<?php

namespace Nebula;

use Nebula\Routing\Route;

class App {

    /**
     * Dispatch Route
     * @param string $directory
     * @return string
     */
    function run(string $directory) {
        $route = Route::instance();
        $route->parseControllers($directory);
        return $route->dispatch($directory);
    }
}
