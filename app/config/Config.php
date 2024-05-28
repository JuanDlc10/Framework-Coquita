<?php

namespace config;

use controller\Login;

class Config
{
    private const SERVER = "http://url-host-virtual";
    private const DEP_IMG = self::SERVER . "/public/img/";
    private const DEP_JS = self::SERVER . "/public/js/";
    private const DEP_CSS = self::SERVER . "/public/css/";
    private const ERROR = ['Error', 'index'];
    private $controller;
    private $method;
    private $routes = [];
    private $ruta2 = [];
    private $importacion;

    public function __construct()
    {
        $this->importacion;
    }

    public function get($ruta, $metodo)
    {
        $ruta_final = trim($ruta, "/");
        $this->routes['GET'][$ruta_final] = $metodo;
    }
    public function put($ruta, $metodo)
    {
        $ruta_final = trim($ruta, "/");
        $this->routes['PUT'][$ruta_final] = $metodo;
    }
    public function post($ruta, $metodo)
    {
        $ruta_final = trim($ruta, "/");
        $this->routes['POST'][$ruta_final] = $metodo;
    }
    public function delete($ruta, $metodo)
    {
        $ruta_final = trim($ruta, "/");
        $this->routes['DELETE'][$ruta_final] = $metodo;
    }

    public function verificar_sesion()
    {
        self::iniciarSesion();
        if (!isset($_SESSION['usuario_id'])) {
            self::redirigir('/login');
            exit;
        }
    }
    public function match_route($ruta, $method)
    {
        if (preg_match('/[a-zA-Z0-9_-]\/[a-zA-Z0-9_-]/', $ruta)) {
            $this->ruta2 = explode('/', $ruta);
            $this->controller = array_key_exists($this->ruta2[0], $this->routes[$method]) ? $this->routes[$method][$this->ruta2[0]] : self::ERROR;
        } else {
            $this->controller = array_key_exists($ruta, $this->routes[$method]) ? $this->routes[$method][$ruta] : self::ERROR;
        }
        $this->method = $this->controller[1];
        require_once './app/controller/' . $this->controller[0] . '.php';
        $this->importacion = $controlador;
    }
    public function run()
    {
        $ruta = $_SERVER['REQUEST_URI'];
        $ruta = trim($ruta, '/');
        $this->match_route($ruta, $_SERVER['REQUEST_METHOD']);
        $metodo = $this->method;
        if(count($this->ruta2)>1){
            $this->importacion->$metodo($this->ruta2[1]);
        }else{
            $this->importacion->$metodo();
        }
    }


    public function redireccion($ruta)
    {
        $ruta_completa = self::SERVER . '/' . $ruta;
        return $ruta_completa;
    }
    static function depJs($archivo)
    {
        return self::DEP_JS . $archivo;
    }
    static function depCss($archivo)
    {
        return self::DEP_CSS . $archivo;
    }
    static function depImg($archivo)
    {
        return self::DEP_IMG . $archivo;
    }
    public function redirigir($ruta)
    {
        echo '
        <script>
            window.location="' . $ruta . '"
        </script>';
    }
    public function iniciarSesion()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function destruir_sesion()
    {
        self::iniciarSesion();
        $_SESSION = array();
        session_destroy();
        Config::redirigir('/');
    }
}
