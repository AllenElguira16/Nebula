<?php

namespace App\Controllers;

use Nebula\Routing\Attributes\Controller;
use Nebula\Routing\Attributes\{Get, Post};
use Nebula\Http\Request;
use Nebula\Http\Response;

#[Controller('/user')]
class UserController {

    #[Get()]
    public function getUser(Request $request, Response $response) {


        return $response->send([
            'username'  => 'AllenKunn16',
            'password'  => 'somewhatsecuredpassword',
            'firstname' => 'Allen',
            'lastname'  => 'Kunn',
        ]);
    }
}
