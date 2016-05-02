<?
require_once("php_lib/interfaz.class.php");
require_once('php_lib/user.class.php');
require('php_lib/restringir_acceso.php');
$interfaz=new interfaz();
$interfaz->hacer_cabecera("page4");
$ci=$_SESSION['USUARIO']['user'];
$n=$_SESSION['USUARIO']['nombre'];
$app=$_SESSION['USUARIO']['app'];
$apm=$_SESSION['USUARIO']['apm'];
$a=new user();
$a->setCI($ci);
if($_SERVER['REQUEST_METHOD']=='POST') 
	{
	
		$query='UPDATE  usuario
			SET  direccion ="'.$_POST['dir'].'",
			telf =  '.$_POST['tel'].',
		    mail ="'.$_POST['mail'].'"
			WHERE  usuario.id='.$ci;
	$a->modificardatos($query);
	?>
<div id="cuerpo">
<font class="label">Datos guardados exitosamente.</font><br><br>
<a href="adm.php">Continuar</a>
</div>
	
	<?}
else
	{
$query=
'select *
from usuarios p
where p.id="'.$ci.'"';
$result=$a->obtenerDatos($query);
if ($row = mysqli_fetch_array($result)){
$dir=$row["direccion"];
$tel=$row["telf"];
$mail=$row["mail"];
?>
<div id="cuerpo">
<form action="adm_adm.php" method="post">
<table>
	<tr>
		<td colspan="3">
		<font class="Titulos"><strong>Datos Personales</strong></font><br><br>
		</td>
	</tr>
	<tr>
		<td>
			<font class="label"><strong>Usuario:&nbsp;</strong></font>
		</td>
		<td colspan="2">
			<font class="label"><?=utf8_encode($n." ".$app." ".$apm )?></font></br>
		</td>
	</tr>
	<tr>
		<td>
			<font class="label"><strong>CI: </strong></font>
		</td>
		<td colspan="2">
			<font class="label"><?=($ci)?></font></br>
		</td>
	</tr>
 </table>
 	<center>
<table width="400px">
<tr>
	<td width="90px" align="left"><label class="label">Direcci&oacute;n:</label></td>
	<td width="450px" align="right"><input size="30" value="<?=$dir?>" type="text" name="dir" placeholder="Ingresa tu direcci&oacute;n actual." /></td>
</tr>
<tr>
	<td align="left"><label class="label">Tel&eacute;fono:</label><br></td>
	<td align="right"><input size="30" maxlength="8"  value="<?=$tel?>" type="number" name="tel" placeholder="Ingresa tu tel&eacute;fono" /><br></td>
<br>
</tr>

<tr>
	<td align="left"><br><label class="label">Email:</label></td>
	<td align="right"><br><input size="30" value="<?=$mail?>" type="email" name="mail" placeholder="Ingresa tu E-Mail." /></td>
	</tr>
<tr>
	<td colspan="2"><h1></h1></td>
</tr>
<tr>
	<td colspan="2" align="center"><input class="button1" type="submit" value="Registrar" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick= location.href='principal.php'  value="Cancelar" class="button1" /></td>
</tr>
</table>
 
</form>
</div>
<?
}
}
?>
</div>
</html>