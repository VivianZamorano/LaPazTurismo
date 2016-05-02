<?
class conexion
	{public $server;
	private $user;
	private $pass;
	private $base;

	
	public function __construct()
		{$this->server = 'localhost';
		$this->user = 'root';
		$this->pass = 1;
		$this->base = 'geolocalizacion';
		}
		
	public function setServer($servidor)
		{$this->server = $servidor;			
		}
	
	public function getServer()
		{return $this->server;
		}
	
	public function setUser($usuario)
		{$this->user= $usuario;			
		}
	
	public function getUser()
		{return $this->user;
		}
		
	public function setPass($password)
		{$this->pass= $password;			
		}
	
	public function getPass()
		{return $this->pass;
		}
		
	public function setBase($bdd)
		{$this->base = $bdd;			
		}
	
	public function getBase()
		{return $this->base;
		}
		
	public function conectar()
		{
		$link =  mysqli_connect($this->server,$this->user,$this->pass,$this->base);
        if (!$link) 
        	{
            trigger_error('Error al conectar al servidor mysql: ' . mysqli_error(),E_USER_ERROR);
        	}
        return $link;
   		}
	}
?>