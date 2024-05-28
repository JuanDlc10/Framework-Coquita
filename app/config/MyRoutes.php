<?php

namespace Config;

use config\Config;

require_once realpath('./vendor/autoload.php');
$router = new Config;

$router->get("/", ['Example', 'index']);


$router->run();


?>
