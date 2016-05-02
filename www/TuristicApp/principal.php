<?php
require('php_lib/restringir_acceso.php');
$u=$_SESSION['USUARIO']['ci'];
$n=$_SESSION['USUARIO']['nombre'];
$app=$_SESSION['USUARIO']['app'];
$apm=$_SESSION['USUARIO']['apm'];
$mensaje= utf8_encode("<br>Bienvenido(a)  ".$n." ".$app." ".$apm);
require_once("php_lib/interfaz.class.php");
$interfaz=new interfaz();
$interfaz->hacer_cabecera("principal");
?>
<div id="cuerpo">	
	<center>	
      				<font class="Titulos"><strong><?=$mensaje?></strong></font></br></br>
			<ul  id= "iconos">
<li id="a"><a href="b_persona.php" title="Busqueda de Personas"></a></li>
<li id="b"><a href="geolocalizacion.php" title="Monitoreo Global"></a> </li>
<li id="c"><a href="adm.php" title="Administrar mi Cuenta"></a></li>
<li id="d"><a href="geolocalizacion.php" title="Cambio de Contraseña"></a> </li>
<li id="e"><a href="logout.php" title="Cerrar Sesión"></a></li>
</ul> 
<div id="menu_label">
	<font class="Subtitulos"><strong>
		<table>
			<tr><td width="210"><p>BUSQUEDA DE<br>PERSONAS</p></td><td width="160"><p>MONITOREO<br>GLOBAL</p></td>
				<td width="180"><p>ADMINISTRAR<br>MI CUENTA</p></td><td width="210"><p>CAMBIO DE<br>CONTRASEÑA</p></td>
				<td width="180"><p>CERRAR<br>SESION</p></td><td></tr></table></strong></font>
	</div>
				</div>
				<center>
		</body>
</html>