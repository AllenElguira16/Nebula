<?php

namespace Nebula\Routing;

use Nebula\Routing\Attributes\Controller;
use Nebula\Http\{Request, Response, ResponseBag};

class ControllerParser{
    /**
     * Parse Controller entry point
     * @param $directory
     * @return mixed
     */
    public static function parse($directory) {
        $self = new ControllerParser();
        return $self->run($directory);
    }

    /**
     * Run parser
     * @param $directory
     * @return mixed
     */
    public function run($directory) {
        foreach($this->parseControllers($directory) as $parsedController) {
            $route = $this->parseRoute($parsedController['name'], $parsedController['methods'], $parsedController['prefix']);

            $uri = $route['uri'];

            if (preg_match($this->convertURI($uri), urldecode(Request::URI()), $matches)) {
                $this->store($matches);

                return $route['controller'];
            }
        }
    }

    /**
     * Parse Controllers
     * @param $directory
     * @return array
     * @throws \ReflectionException
     */
    private function parseControllers($directory) {
        $controllerFileNames = array_values(array_diff(scandir($directory . '/src/controllers'), ['..', '.']));
        $controllers = [];

        foreach($controllerFileNames as $controllerFileName) {
            $controllerClassName = $this->file_get_php_classes($directory.'\\src\\controllers\\'.$controllerFileName)[0];
            $controllerName = 'App\Controllers\\'.$controllerClassName;

            $reflectionClass = new \ReflectionClass($controllerName);
            $methods = $reflectionClass->getMethods();

            $classAttributes = $reflectionClass->getAttributes(Controller::class)[0];
            $prefix = $classAttributes->newInstance()->prefix;
            $controllers[] = [
                'name' => $reflectionClass->getName(),
                'methods' => $methods,
                'prefix' => $prefix
            ];
        }

        return $controllers;
    }

    /**
     * Parse Routes
     * @param $controller
     * @param $methods
     * @param $prefix
     * @return array
     */
    private function parseRoute($controller, $methods, $prefix) {
        foreach($methods as $method) {
            $requestMethod = 'Nebula\Routing\Attributes\\'.ucfirst(strtolower(Request::requestMethod()));

            $getMethodAttributes = $method->getAttributes($requestMethod, \ReflectionAttribute::IS_INSTANCEOF);
            foreach($getMethodAttributes as $getMethodAttribute) {
                
                $uri = '/api'.$prefix.$getMethodAttribute->newInstance()->uri;
                $controllerInstance = new $controller();

                return [
                    'uri' => $uri,
                    'controller' => [
                        'name'   => $controllerInstance,
                        'method' => $method->name
                    ] 
                ];
            }
        }
    }

    /**
     * Store path params to RequestBag
     * @param $matches
     */
    private function store($matches) {
        foreach ($matches as $key => $match) {
            if (is_string($key)) {
                RequestBag::set('path', $key, $match);
            }
        }
    }
    
    /**
     * Handling URI
     *
     * Basically were converting the string into a Regex Delimiter
     * for example
     *     string: /User/:id
     *     Regex: \/User\/\:(?'id'[a-zA-Z0-9]+)
     *
     * @param string $uri
     * @return string
     */
    protected function convertURI(string $uri): string
    { 
        if ($uri == "*") {
            return "/^(?'any'.*)$/";
        }
        $uri = preg_replace('/^(.+)\/$/', '$1', $uri);
        $uri = preg_replace('/\//', '\/', $uri);
        $uri = preg_replace('/\:([a-zA-Z0-9]+)/', "(?'$1'.+)", $uri);
        $uri = preg_replace('/\:([a-zA-Z0-9]+)/', "(?'$1'.+(?=\/))", $uri);
        return "/^$uri$/";
    }

    /**
     * Get php classes from file
     * 
     * @param string $filepath
     */
    private function file_get_php_classes($filepath) {
        $php_code = file_get_contents($filepath);
        $classes = $this->get_php_classes($php_code);
        return $classes;
    }

    /**
     * Get php classes
     * 
     * @param string $php_code A php code from string
     */
    private function get_php_classes($php_code) {
        $classes = [];
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (   $tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING) {
        
                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }
        return $classes;
    }
}
