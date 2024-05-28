<?php

namespace Config;

class View
{
    public function vista($mi_vista, $datos = ['']) {
        if (file_exists('./view/'.$mi_vista.'.view.php')) {
            $mi_vista = './view/'.$mi_vista.'.view.php';
        }else{
            $mi_vista = './view/error.view';
        }
        $datos;
        require_once $mi_vista;
    }
}
