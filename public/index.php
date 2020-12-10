<?php 

declare(strict_types=1);

error_reporting(E_ALL);

require_once dirname(__DIR__).'/vendor/autoload.php';

$app = new Nebula\App();

echo $app->run(dirname(__DIR__));
