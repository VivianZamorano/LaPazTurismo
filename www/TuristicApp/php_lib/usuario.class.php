<?php

require 'conexion.class.php';

class usuario
	{public $user;
	private $pass;
	public $user_field;
	public $pass_field;
	public $table_name;
	private $conector;
	public $ci;	
	public $nombre;
	public $apellidop;
	public $apellidom;
	public $nacimiento;
	public $sexo;
	public $direccion;
	public $telefono='NULL';
	public $email='NULL';
	public $empresa;
	
	
	public function __construct()
		{$this->conector = new conexion();
		$this->conector->conectar(); 
		$this->user="";
		$this->pass="";
		$this->user_field="ci";
		$this->pass_field="pass";
		$this->table_name="";
		}
		
	public function setUser($u)
		{$this->user= $u;			
		}
	
	public function getUser()
		{return $this->user;
		}
		
	public function setPass($p)
		{$this->pass= $p;			
		}
	
	public function getPass()
		{return $this->pass;
		}
		
	public function setUserField($uf)
		{$this->user_field= $uf;			
		}
	
	public function getUserField()
		{return $this->user_field;
		}

	public function setPassField($pf)
		{$this->pass_field= $pf;			
		}
	
	public function getPassField()
		{return $this->pass_field;
		}
		
	public function setTableName($t)
		{$this->table_name= $t;			
		}
	
	public function getTableName()
		{return $this->table_name;
		}
		
	public function checkUser()
		{if (empty($this->user)) return false;
		$query='SELECT '.$this->user_field.' 
				FROM '.$this->table_name.' 
				WHERE '.$this->user_field.'="'.  mysqli_real_escape_string($this->conector->conectar(),$this->user).'" 
				LIMIT 1 ';
        $result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
		$row = mysqli_fetch_assoc($result);
		if($row)
			{return true;	
			}
		else 
			{return false;	
			}
		}
		
	public function checkPass()
		{if (empty($this->pass)) return false;
		$query='SELECT * FROM '.$this->table_name.' WHERE '.$this->user_field.'="'.  mysqli_real_escape_string($this->conector->conectar(),$this->user).'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
        $result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
		$row = mysqli_fetch_assoc($result);
		$hash=md5($this->pass);
		if ($hash==$row[$this->pass_field]) 
            {
                @session_start();
                $_SESSION['USUARIO']=array('user'=>$row['id'], 'nombre'=>$row['n'], 'app'=>$row['app'], 'apm'=>$row['apm']);
                return true; 
            } 
		else 
            	{
                @session_start();
                unset($_SESSION['USUARIO']); 
                return false; 
            }
		}
		
	public function tryCount()
		{if (empty($this->user)) return false;
		$query='SELECT try FROM '.$this->table_name.' WHERE '.$this->user_field.'="'.  mysqli_real_escape_string($this->conector->conectar(),$this->user).'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
        $result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
		$row = mysqli_fetch_assoc($result);
		return $row['try'];		
		}
	
	public function tryIncrease()
		{$c=$this->tryCount();
		$query='UPDATE '.$this->table_name.' 
				SET  try = '.($c+1).'
				WHERE '.$this->user_field.' ="'.$this->user.'"';
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		}
		
	public function tryReset()
		{
		$query='UPDATE '.$this->table_name.' 
				SET  try = '.(0).'
				WHERE '.$this->user_field.'='.$this->user;
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		}

    public function estoy_logeado () 
    	{
        @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
        if (!isset($_SESSION['USUARIO'])) return false; //no existe la variable $_SESSION['USUARIO']. No logeado.
        if (!is_array($_SESSION['USUARIO'])) return false; //la variable no es un array $_SESSION['USUARIO']. No logeado.
        if (empty($_SESSION['USUARIO']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.
        return true;//cumple las condiciones anteriores, entonces es un usuario validado
        }
    /**
     * Vacia la sesion con los datos del usuario validado
     */
    public function logout() 
    	{
        @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
        unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
        session_write_close(); //nos asegurmos que se guarda y cierra la sesion
        return true;
		}
	
	public function setCI($ci)
		{$this->ci= $ci;			
		}
	public function getStatus()
		{if (empty($this->user)) return false;
		$query='SELECT sid FROM '.$this->table_name.' WHERE '.$this->user_field.'="'.  mysqli_real_escape_string($this->conector->conectar(),$this->user).'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
        $result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
		$row = mysqli_fetch_assoc($result);
		return $row['sid'];		
		}
		
			
		//OBTENER UBICAION VIAJERO
	public function obtenerBusquedaPersona($doc)
		{
		$query=
				'SELECT a.ci, a.n nombre, a.app apaterno, a.apm amaterno, c.f fecha, d.p placa, d.d descricpcion, e.n empresa, f.latitud, f.longitud, f.date
FROM persona a, registro b, viaje c, autos d, empresa e, reg_viaje f, reg_viaje g
WHERE a.ci = b.cli
AND b.vid = c.id
AND c.recibido =1
AND c.aid = d.id
AND e.id = c.eid
AND f.viaje_id = g.viaje_id
AND f.viaje_id = c.id
AND f.id != g.id
AND a.ci ="'.$doc.'"
GROUP BY DATE
ORDER BY DATE DESC
LIMIT 1';
				
				
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		return $result;
		}
	//MOSTRAR Persona
	public function mostrarBusquedaPersona($doc)
		{$viaje=$this->obtenerBusquedaPersona($doc);
		if ($row = mysqli_fetch_array($viaje))
			{
			?>
			<table  id='htmlgrid' class='testgrid'>
			<tr id='titulotabla' align="right"><th>NOMBRE</th><th>FECHA</th><th>PLACA DE AUTOMOVIL</th><th>DESCRIPCION AUTOMOVIL</th><th>EMPRESA DE VIAJE</th><th>POSICION</th><th>FECHA</th><th></th></tr>
			<?
			do
				{ 
				echo "<tr align='center'><td>".utf8_encode($row["nombre"]." ".$row["apaterno"]." ".$row["amaterno"])."</td>
				<td>".$row["fecha"]."</td>
				<td>".$row["placa"]."</td>
				<td>".$row["descripcion"]."</td>
				<td>".$row["empresa"]."</td>
				<td>Lon:".$row["longitud"]." Lat:".$row["latitud"]."</td>
				<td>".$row["date"]."</td>
				<form action='geolocalizacion.php' enctype='multipart/form-data' method='GET'>
				<input type='hidden' name='ci' value=".$row['ci'].">
				<input type='hidden' name='lat' value=".$row['latitud'].">
				<input type='hidden' name='lon' value=".$row['longitud']."><input type='hidden' name='dato' value=".$row['date'].">
				<td valign='center'>
				<input type='submit' value='Ver en GMaps' class='input'/></form></td>"; 
				} while ($row = mysqli_fetch_array($viaje));  
   			} 
		else 
			{ 
			echo "¡ No se ha encontrado ningún registro !"; 
			}	
			
			
		}
		
    }

?>
