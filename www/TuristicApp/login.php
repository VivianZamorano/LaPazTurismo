<?php
include('php_lib/usuario.class.php');
require_once("php_lib/interfaz.class.php");
$interfaz=new interfaz();

$u=new usuario();
    $u->setUser($_POST['usuario']);
	$u->setPass($_POST['password']);
	$u->setTableName('usuarios');
if ($_SERVER['REQUEST_METHOD']=='POST') 
	{
		if($u->getUser()=="" AND $u->getPass()=='NULL' ) {
			$mensaje="<strong>Debe ingresar datos antes de continuar.<strong>";
		}
		else {
			
    if ($u->checkUser())
		{if($u->checkPass())
			{$u->tryReset();
			
				
					header('Location:principal.php');        	
					
					
					
			die();
			}
		else
			{$mensaje='<strong>Usuario o contraseña incorrecta.<strong>';	
			$u->tryIncrease();
			}
		}
	else 
		{$mensaje="<strong>Este usuario no se encuentra registrado <a href='registro.php'>REGISTRARSE</a>.<strong>";
		}
	
		}	
	
	}
if($u->tryCount()<3)
	{?><br><br><br><br><br><br><?
	$interfaz->hacer_cabecera("login");
	if (empty($mensaje)) 
		{$m="Por favor ingrese su nombre de usuario y contrase&ntilde;a.";
		}
	else 
		{$m=$mensaje;
		}
	$interfaz->PantallaLogin("login.php","INGRESO AL SISTEMA",$m);
	}
else 
	{
	header('Location:index.php');	
	}
	
	
	
?>