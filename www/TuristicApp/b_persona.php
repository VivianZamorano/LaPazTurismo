<?
require_once("php_lib/interfaz.class.php");
require_once('php_lib/usuario.class.php');
require('php_lib/restringir_acceso.php'); 
$interfaz=new interfaz();
$reg=new usuario();
$interfaz->hacer_cabecera("page4");
$ci=$_SESSION['USUARIO']['user'];
$n=$_SESSION['USUARIO']['nombre'];
$app=$_SESSION['USUARIO']['app'];
$apm=$_SESSION['USUARIO']['apm'];
?>
<div id="cuerpo">
	<br>
	<br>
	<br>
	<font class="Titulos"><strong>Buscar Persona</strong></font></br><br>
	<font class="label"><strong>Documento de Identidad:</strong></font></br>
	<div>
<div>
	<form method="post">
		<input type="number" step="1" value="<?=$_POST['ci']?>" name="ci" placeholder="Documento de identidad">
		<input type="submit" name="submit" class="button1" value="Buscar">
		<input type="button" onclick= location.href="principal.php"  value="Volver" class="button1" />
	</form>
	
</div>
			
</div>
	
<?

if($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$reg->mostrarBusquedaPersona($_POST["ci"]);	
	
	}
?>
	</div>
</html>