# <a name="nebula"></a> Nebula
A PHP MVC Framework with React as frontend

## <a name="getting-started"></a> Getting Started

Before installing you must need an npm or yarn for installing 
javascript modules and composer for php modules

```bash 
$ composer install
```  
```bash
$ npm install //or yarn install
```

then run the program in two separate terminals

```bash
$ npm start //or yarn start
```

```bash
$ php console serve
```

And you can access it in <https://localhost:8000>

## <a name="controllers"></a> Controllers
Controllers handles incomming requests and returning responses to the browser

### <a name="routing"></a> Routing

In routing, we will use the `#[Controller()]` attribute which is required to define a controller. It also serve as a routing mechanism

The parameter used in `#[Controller()]` is the prefix of the route

In methods, we will use `#[Get()]` or `#[Post()]` to make and endpoint. Also it always return an JSON Object

*note*: Every controller has a prefix of `/api`

```php
<?php

namespace App\Controllers;

use Nebula\Routing\Attributes\Controller;
use Nebula\Routing\Attributes\{Get, Post};
use Nebula\Http\Request;
use Nebula\Http\Response;

#[Controller('/')]
class HomeController {

    /**
     * example endpoint: /api
     **/
    #[Get()]
    public function hello(Request $request, Response $response) {
        return $response->send([
            'msg' => 'welcome to nebula/api'
        ]);
    }

    /**
     * example endpoint: /api/hello
     **/
    #[Get('hello')]
    public function helloWorld() {
        return 'welcome to nebula/api';
    }
}

```
