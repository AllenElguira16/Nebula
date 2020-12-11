<?php

namespace App\Controllers;

use Nebula\Routing\Attributes\Controller;
use Nebula\Routing\Attributes\{Get, Post};
use Nebula\Http\Request;
use Nebula\Http\Response;

#[Controller('/')]
class HomeController {

    #[Get()]
    public function hello(Request $request, Response $response) {
        return $response->send([
            'hello' => 'world'
        ]);
    }

    #[Get('hello')]
    public function helloWorld() {
        return 'Hello World';
    }
}
