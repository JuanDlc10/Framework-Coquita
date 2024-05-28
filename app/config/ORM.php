<?php

namespace config;

use config\Conexion;
use PDO;

require_once realpath('./vendor/autoload.php');
class ORM
{
    protected $tabla;
    protected $id_tabla;
    protected $atributos;
    private $query;
    private $contadorWhere;
    function __construct()
    {
        $this->atributos = $this->atributos_tabla();
    }

    private function atributos_tabla()
    {
        $consulta = Conexion::obtener_conexion()->prepare("DESCRIBE $this->tabla");
        $consulta->execute();
        $campos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $atributos = [];
        foreach ($campos as $campo) {
            array_push($atributos, $campo['Field']);
        }
        return $atributos;
    }

    public function where($campo, $valor_campo = '', $tipo = 'AND')
    {
        $queryFinal = $this->query;
        if ($this->contadorWhere > 0) {
            $this->query = "$queryFinal " . ($tipo != "AND" ? 'OR' : $tipo) . " $campo = '$valor_campo'";
        } else {
            if ($valor_campo == '') {
                $this->query = "$queryFinal WHERE $campo";
            } else {
                $this->query = "$queryFinal WHERE $campo = '$valor_campo'";
                $this->contadorWhere++;
            }
        }
        return $this;
    }

    public function all()
    {
        $queryFinal = $this->query;
        $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
        if ($consulta->execute()) {
            $data = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $data = [];
        }
        return $data;
    }

    public function first()
    {
        $queryFinal = $this->query;
        $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
        if ($consulta->execute()) {
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = [];
        }
        return $data;
    }
    public function get()
    {
        $queryFinal = $this->query;
        $consulta = Conexion::obtener_conexion()->prepare($queryFinal);
        return $consulta->execute();
    }

    public function consulta($seleccion = ['*'])
    {
        $seleccion = implode(',', $seleccion);
        $this->query = "SELECT $seleccion FROM $this->tabla";
        return $this;
    }
    public function count($condicion = '', $valor = '')
    {
        $query = "SELECT COUNT(*) FROM $this->tabla";
        if ($condicion != '') {
            $query .= " WHERE $condicion = '$valor'";
        }
        $consulta = Conexion::obtener_conexion()->prepare($query);
        $consulta->execute();
        $resultado = $consulta->fetchColumn();
        return $resultado;
    }

    public function limite($limit = 100, $offset = 0)
    {
        $queryChida = $this->query;
        $this->query = "$queryChida LIMIT $limit";
        if ($offset > 0) {
            $this->query .= " OFFSET $offset";
        }
        return $this;
    }
    public function like($valor)
    {
        $queryChida = $this->query;
        $this->query = "$queryChida LIKE '$valor'";
        return $this;
    }
    public function max($valor)
    {
        $this->query = "SELECT MAX($valor) FROM $this->tabla";
        return $this;
    }
    public function min($valor)
    {
        $this->query = "SELECT MIN($valor) FROM $this->tabla";
        return $this;
    }
    public function sum($valor)
    {
        $this->query = "SELECT SUM($valor) FROM $this->tabla";
        return $this;
    }
    public function avg($valor)
    {
        $this->query = "SELECT AVG($valor) FROM $this->tabla";
        return $this;
    }
    public static function mostrar_datos()
    {
        $consulta = Conexion::obtener_conexion()->prepare("SELECT * FROM t_persona");
        if (!$consulta->execute()) {
            echo 'No se pudo realizar la consulta';
        } else {
            $dato = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo print_r($dato);
            echo 'Se completo la peticion';
        }
    }
    public function insercion($datos)
    {
        $temp = array();
        foreach ($this->atributos as $valor) {
            if ($this->id_tabla != $valor) {
                array_push($temp, $valor);
            }
        }
        $propiedades  = implode(",", $temp);
        $propiedades_key = ":" . implode(", :", $temp);
        $consulta = Conexion::obtener_conexion()->prepare("INSERT INTO $this->tabla ($propiedades) VALUES ($propiedades_key)");
        if ($consulta->execute($datos)) {
            return ([1, "Insercion correcta"]);
        } else {
            return ([0, "Error al insertar datos"]);
        }
    }

    public function actualizar($datos)
    {
        $query1 = [];
        foreach (array_keys($datos) as $key) {
            if ($this->id_tabla != $key) {
                array_push($query1, $key . '=' . "'$datos[$key]'");
            }
        }
        $query1 = implode(', ', $query1);
        $this->query = "UPDATE $this->tabla SET $query1";
        return $this;
    }

    public function eliminar()
    {
        $this->query = "DELETE FROM $this->tabla";
        return $this;
    }
}

/* Crear 3 tablas mas, crear 3 controladores mas, y 3 modelos mas TEREA */
/* Agrega COUNT */