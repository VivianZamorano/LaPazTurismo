<?php
header('Access-Control-Allow-Origin: *');
require 'conexion.class.php';

class maps
{
    public $maps;
    public $longitud;
    public $latitud;
    public $table_name;
    private $conector;
    public static $puntos = array(
        "ATRACTIVO_TURISCTICO" => "Atractivo Turistico",
        "HOTEL" => "Hotel",
        "RESTAURANTE" => "Restaurante");

    public function __construct()
    {
        $this->conector = new conexion();
        $this->conector->conectar();
        $this->table_name = "turi_ubicacion";
    }

    public function setLongitud($u)
    {
        $this->longitud = $u;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }

    public function setLatitud($u)
    {
        $this->latitud = $u;
    }

    public function getLatitud()
    {
        return $this->latitud;
    }

    public function setTableName($u)
    {
        $this->table_name = $u;
    }

    public function getTableName()
    {
        return $this->table_name;
    }

    public function getPosicionPuntosInteres($idLocacion, $tipoPunto = "")
    {
        $query = "Select turi_ubicacion.longitud,  
                         turi_ubicacion.latitud,
                         a.id,
                         a.nombre, 
                         a.descripcion, 
                         a.tipo_punto, 
                         a.telefono1, 
                         a.telefono2, 
                         a.direccion, 
                         a.puntaje 
                  from   turi_ubicacion, turi_punto_interes a, turi_locacion b
                  where a.id_ubicacion =   turi_ubicacion.id
                  and a.id_locacion =" . $idLocacion;
        if ($tipoPunto != "") {
            $query = $query . " and a.tipo_punto =" . self::$puntos[$tipoPunto];
        }
        $result = mysqli_query($this->conector->conectar(), $query);
        if (!$result) {
            trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector), E_USER_ERROR);
        }
        $id = null;
        $array = array();
        while ($obj = mysqli_fetch_object($result)) {
            if ($id != $obj->id){
                array_push($array ,array(
                    'id' => $obj->id,
                    'nombre' => $obj->nombre,
                    'descripcion' => $obj->descripcion,
                    'tipo_punto' => $obj->tipo_punto,
                    'telefono1' => $obj->telefono1,
                    'telefono2' => $obj->telefono2,
                    'direccion' => $obj->direccion,
                    'puntaje' => $obj->puntaje,
                    'longitud' => $obj->longitud,
                    'latitud' => $obj->latitud,
                ));
                $id = $obj->id;
            }
        }
        echo '' . json_encode($array) . '';
        exit;
    }

    public function getPosicionZona($idLocacion)
    {
        $query = "Select turi_ubicacion.longitud,  
                         turi_ubicacion.latitud
                  from   turi_ubicacion, turi_locacion a
                  where a.id_ubicacion =   turi_ubicacion.id
                  and a.id = " . $idLocacion;
        $result = mysqli_query($this->conector->conectar(), $query);
        if (!$result) {
            trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector), E_USER_ERROR);
        }
        $array = array();
        while ($obj = mysqli_fetch_object($result)) {
            $array[] = array(
                'longitud' => $obj->longitud,
                'latitud' => $obj->latitud,
            );
        }
        echo '' . json_encode($array) . '';
        exit;
    }

}

if ($_GET["metodo"] == "PtsIntrs") {
    $u = new maps();
    $u->getPosicionPuntosInteres($_GET["IdLocacion"], $_GET["tipoPunto"]);
}
if ($_GET["metodo"] == "Locacion") {
    $u = new maps();
    $u->getPosicionZona($_GET["IdLocacion"]);
}
?>