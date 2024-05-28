<?php

namespace Config;

use config\Config;

require_once realpath('./vendor/autoload.php');
$router = new Config;

$router->get("/", ['Login', 'index']);
$router->get("/sigin", ['Login', 'sigin']);
$router->post("/validarLogin", ['Login', 'verificar_login']);
$router->post("/validarRegistro", ['Sigin', 'verificar_login']);
$router->get("/logout", ['Login', 'cerrar_sesion']);
$router->get("/inicio", ['Productos', 'index']);
$router->get("/agregar", ['Productos', 'agregar_vista']);

$router->run();


?>