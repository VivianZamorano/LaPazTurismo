<?
require 'usuario.class.php';

class geolocalizacion extends usuario
	{
	private $conector;
	
	
	
	public function __construct()
		{$this->conector = new conexion();
		$this->conector->conectar(); 
		}   
	public function localizar()	{
$sql="SELECT * 
FROM reg_viaje
WHERE id
IN (

SELECT id
FROM (

SELECT DISTINCT group, (

SELECT MAX( B.id ) id
FROM reg_viaje B
WHERE A.group = B.group
) AS id
FROM reg_viaje A
)VISTA
)";

$result = mysqli_query($this->conector->conectar(),$sql);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
$arr = array();
while ($obj = mysqli_fetch_object($result)) {
    $arr[] = array('id' => $obj->viaje_id,
                   'lng' => $obj->longitud,
                   'lat' => $obj->latitud,
        );
}
echo '' . json_encode($arr) . '';
	}
	
	public function localizaciones()
	{
		$sql="select * from ruta";

$result = mysqli_query($this->conector->conectar(),$sql);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
$arr = array();
while ($obj = mysqli_fetch_object($result)) {
    $arr[] = array('id' => $obj->id,
                   'lng' => $obj->longitud,
                   'lat' => $obj->latitud,
                   'n' => $obj->n,
                   'd' => $obj->d,
                   'p' => $obj->precede,
                   'size' => $obj->size,
                   
        );
}
echo '' . json_encode($arr) . '';
	}

public function recorrido($id)
{
$query="SELECT a.ci, a.n nombre, a.app apaterno, a.apm amaterno, c.f fecha, d.p placa, d.d descricpcion, e.n empresa, f.latitud, f.date as fecha1, f.longitud 
FROM persona a, registro b, viaje c, autos d, empresa e, reg_viaje f, reg_viaje g
WHERE a.ci = b.cli
AND b.vid = c.id
AND c.recibido =1
AND c.aid = d.id
AND e.id = c.eid
AND f.viaje_id = g.viaje_id
AND f.viaje_id = c.id
AND f.id != g.id
AND a.ci ='".$id."'
GROUP BY fecha1
ORDER BY fecha1 ASC";
$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
$arr1 = array();
while ($obj = mysqli_fetch_object($result)) {
    $arr1[] = array('date' => $obj->fecha1,
                   'lng' => $obj->longitud,
                   'lat' => $obj->latitud,
        );
}
echo '' . json_encode($arr1) . '';
}
	}
if ($_SERVER['REQUEST_METHOD']=='POST') 
	{

$u=new geolocalizacion();
$u->localizar();
		}
	
	if ($_SERVER['REQUEST_METHOD']=='GET' && $_GET["a"]=='a') 
	{

$u=new geolocalizacion();
$u->localizaciones();
		}
		
		if ($_SERVER['REQUEST_METHOD']=='GET' && $_GET["ci"]!=NULL) 
	{

$u=new geolocalizacion();
$u->recorrido($_GET["ci"]);
		}
?>