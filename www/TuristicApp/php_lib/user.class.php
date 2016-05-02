<?

require 'usuario.class.php';

class user extends usuario
	{
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
	private $conector;
	
	
	
	public function __construct()
		{$this->conector = new conexion();
		$this->conector->conectar(); 
		}   
	
	public function setCI($ci)
		{$this->ci= $ci;			
		}
	
	public function getCI()
		{return $this->ci;
		}
		
	public function setNombre($n)
		{$this->nombre= $n;			
		}
	
	public function getNombre()
		{return $this->nombre;
		}
		
	public function setApellidoP($app)
		{$this->apellidop= $app;			
		}
	
	public function getApellidoP()
		{return $this->apellidop;
		}

	public function setApellidoM($apm)
		{$this->apellidom= $apm;			
		}
	
	public function getApellidoM()
		{return $this->apellidom;
		}
			
	public function setDireccion($dir)
		{$this->direccion= $dir;			
		}
	
	public function getDireccion()
		{return $this->direccion;
		}
		
	public function setNacimiento($nac)
		{$this->nacimiento= $nac;			
		}
		
	public function getNacimiento()
		{return $this->nacimiento;
		}
		
	public function setSexo($s)
		{$this->sexo= $s;	
		}
	
	public function getSexo()
		{return $this->sexo;
		}
			
	public function setTelefono($t)
		{$this->telefono= $t;			
		}
		
	public function getTelefono()
		{return $this->telefono;
		}
				
	public function setEmail($e)
		{$this->email= $e;			
		}
	
	public function getEmail()
		{return $this->email;
		}	
	public function setEmpresa($eid)
		{$this->eid= $eid;			
		}
	
	public function getEmpresa()
		{return $this->eid;
		}	
			
				
	public function checkAdmi()
		{$query='select * 
				from persona p 
				where p.ci="'.$this->ci.'" 
				limit 1';
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
	        }
		$row = mysqli_fetch_assoc($result);
		if(!$row)
			{return true;	
			}
		else 
			{return $row;	
			}		
		}
		
	public function enterDataAdmi($a,$b)
		{$query='INSERT INTO '.$a.'(ci, n, app, apm, t, s, m, p, d, f, sid, eid, try)
				VALUES (
				"'.$this->ci.'", 
				"'.$this->nombre.'",  
				"'.$this->apellidop.'",  
				"'.$this->apellidom.'",  
			    "'.$this->telefono.'", 
			    "'.$this->sexo.'",
			    "'.$this->email.'",  
			    MD5("'.$this->ci.'" 	), 
				"'.$this->direccion.'",  
				"'.$this->nacimiento.'",  
				"2",
				"'.$b.'",
				0)';
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
	        }			
		}
	
	
	public function obtenerDatos($query)
		{
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		return $result;
		}
		 
	public function modificardatos($query)
		{
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		} 	
		
	public function checkEmpleado()
		{$query='select a.* 
				from persona a , persona b
				where b.ci="'.$this->ci.'" 
				and (a.sid=2 or a.sid=6)
				and a.eid=b.eid
				limit 1';
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
	        }
		$row = mysqli_fetch_assoc($result);
		if(!$row)
			{return true;	
			}
		else 
			{return $row;	
			}		
		}
		
		
	public function getEid($ci)
		{
		$query='SELECT eid as e FROM persona WHERE ci="'.$ci.'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
        $result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->conector),E_USER_ERROR);
        	}
		$row = mysqli_fetch_assoc($result);
		return $row["e"];	
		}
	//OBTENER EMPLEADOS CHOFERES STATUS 6
	public function obtenerChofer()
		{
		$query=
				'SELECT a.ci AS ci, a.n AS nombre, a.app AS app, a.apm AS apm
				FROM persona a
				WHERE a.eid="'.$this->eid.'"
				AND a.sid=6
				ORDER BY app ASC';
				
				
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		return $result;
		}
	//MOSTRAR CHOFERES
	public function mostrarChofer()
		{$viaje=$this->obtenerChofer();
		if ($row = mysqli_fetch_array($viaje))
			{
			?>
			<table id='htmlgrid' class='testgrid'>
			<tr id='titulotabla' align="right"><th>CODIGO</th><th>NOMBRE</th></tr>
			<?
			do
				{ 
				echo "<tr align='center'><td>".strtoupper($row["ci"])."</td>
				<td>".$row["nombre"]."    ".$row["app"]."    ".$row["apm"]."</td>
				<td><form action='admivauto.php' enctype='multipart/form-data' method='post'>
				<input type='hidden' name='cid' value=".$row['ci'].">
				<input type='submit' value='Seleccionar' class='seleccion'/></form></td>"; 
				} while ($row = mysqli_fetch_array($viaje));  
   			} 
		else 
			{ 
			echo "¡ No se ha encontrado ningún registro !"; 
			}	
			
			
		}



//OBTENER AUTOMOVILES DISPONIBLES
	public function obtenerAuto()
		{
		$query=
				'SELECT a.id AS codigo, a.p AS placa, a.c as capacidad
				FROM autos a
				WHERE a.eid="'.$this->eid.'"
				ORDER BY id ASC';
				
				
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		return $result;
		}
	//MOSTRAR AUTOS
	public function mostrarAuto($con)
		{$viaje=$this->obtenerAuto();
		if ($row = mysqli_fetch_array($viaje))
			{
			?>
			<table id='htmlgrid' class='testgrid'>
			<tr id='titulotabla' align="right"><th>CODIGO</th><th>PLACA</th><th>CAPACIDAD</th></tr>
			<?
			do
				{ 
				echo "<tr align='center'><td>".strtoupper($row["codigo"])."</td>
				<td>".$row["placa"]."</td>
				<td>".$row["capacidad"]."</td>
				<td><form action='admi_ruta.php' enctype='multipart/form-data' method='post'>
				<input type='hidden' name='aid' value=".$row['codigo'].">
				<input type='hidden' name='cid' value=".$con.">
				<input type='submit' value='Seleccionar' class='seleccion'/></form></td>"; 
				} while ($row = mysqli_fetch_array($viaje));  
   			} 
		else 
			{ 
			echo "¡ No se ha encontrado ningún registro !"; 
			}	
			
			
		}
	
	

//OBTENER RUTAS DISPONIBLES
	public function obtenerRuta()
		{
		$query=
				'SELECT a.id AS codigo, a.n AS nombre
				FROM ruta a
				ORDER BY id ASC';
				
				
		$result = mysqli_query($this->conector->conectar(),$query);	
		if (!$result) 
			{trigger_error('Error al ejecutar la consulta SQL: ' . mysqli_error($this->link),E_USER_ERROR);
        	}
		return $result;
		}
	//MOSTRAR RUTAS
	public function mostrarRuta($con,$aid)
		{$viaje=$this->obtenerRuta();
		if ($row = mysqli_fetch_array($viaje))
			{
			?>
			<table id='htmlgrid' class='testgrid'>
			<tr id='titulotabla' align="right"><th>CODIGO</th><th>NOMBRE</th></tr>
			<?
			do
				{ 
				echo "<tr align='center'><td>".strtoupper($row["codigo"])."</td>
				<td>".$row["nombre"]."</td>
				<td><form action='admi_ruta.php' enctype='multipart/form-data' method='post'>
				<input type='hidden' name='ruta' value=".$row['codigo'].">
				<input type='hidden' name='cid' value=".$con.">
				<input type='hidden' name='aid' value=".$aid.">
				<input type='submit' value='Seleccionar' class='seleccion'/></form></td>"; 
				} while ($row = mysqli_fetch_array($viaje));  
   			} 
		else 
			{ 
			echo "¡ No se ha encontrado ningún registro !"; 
			}	
			
			
		}
		
		
	
		
	
	}
?>