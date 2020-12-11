<?php

namespace Nebula\Routing;

use Nebula\Http\{Request, Response};

class Dispatcher {

    /**
     * @param array $controller
     * @param string $directory
     * @return false|mixed|string
     */
    public static function dispatch (array $controller, string $directory) {
        ['name' => $name, 'method' => $method] = $controller;
        $request = new Request();
        $response = new Response();
        try {
            if (is_null($name) || is_null($method)) {
                // use template.html if no routes were matched
                return file_get_contents($directory.'/src/views/template.html');
            }

            /**
             * Call Controller
             */
            return call_user_func_array([$name, $method], [$request, $response]);
        } catch (\Throwable $th) {
            return $response->send($th->getMessage());
        }
    }
}
