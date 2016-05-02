<?
//Funcion para hacer la cabecera del documento 
class interfaz
	{
	public static function hacer_cabecera($page)
		{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Parental Control.</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<style type="text/css"></style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
		<link rel="stylesheet" href="css/ie.css" type="text/css" media="all">
		<![endif]-->
		<!--[if lt IE 7]>
			<div style=' clear: both; text-align:center; position: relative;'>
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a>
			</div>
		<![endif]-->
<script language="JavaScript" type="text/JavaScript">
    var Hoy = new Date("<?php echo date("d M Y G:i:s"); ?>");
function Reloj(){ 
    Hora = Hoy.getHours() 
    Minutos = Hoy.getMinutes() 
    Segundos = Hoy.getSeconds() 
    if (Hora<=9) Hora = "0" + Hora 
    if (Minutos<=9) Minutos = "0" + Minutos 
    if (Segundos<=9) Segundos = "0" + Segundos 
    var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"); 
    var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
    var Anio = Hoy.getFullYear(); 
    var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " de " + Anio + ", a las "; 
    var Inicio, Script, Final, Total 
    Inicio = "<font size=3 color=black>" 
    Hora=Hora
    Script = Fecha + Hora + ":" + Minutos + ":" + Segundos 
    Final = "</font>" 
    Total = Inicio + Script + Final 
    document.getElementById('Fecha_Reloj').innerHTML = Total 
    Hoy.setSeconds(Hoy.getSeconds() +1)
    setTimeout("Reloj()",1000) 
} 
</script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="js/jquery-easing-1.3.pack.js"></script>
	<script src="js/jquery-easing-compatibility.1.2.pack.js"></script>
	<script src="js/coda-slider.1.1.1.pack.js"></script>

	<script>
		var theInt = null;
		var $crosslink, $navthumb;
		var curclicked = 0;

		theInterval = function(cur){
			clearInterval(theInt);

			if( typeof cur != 'undefined' )
				curclicked = cur;

			$crosslink.removeClass("active-thumb");
			$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');

			theInt = setInterval(function() {
				$crosslink.removeClass("active-thumb");
				$navthumb.eq(curclicked).parent().addClass("active-thumb");
				$(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 3 == curclicked )
					curclicked = 0;

			}, 5000);
		};

		// DOM Ready
		$(function() {

			$("#main-photo-slider").codaSlider();

			$navthumb = $(".nav-thumb");
			$crosslink = $(".cross-link");

			$navthumb
				.click(function() {
					var $this = $(this);
					theInterval($this.parent().attr('href').slice(1) - 1);
					return false;
				});

			theInterval();
		});
	</script>
</head>

	<body onload="Reloj()">
			<div class="wrapper">
<a href="index.php" id="logo"><h1>&nbsp;</h1><h1>&nbsp;</h1><h1>&nbsp;</h1></a>
				</div>   	
		<div class="main">
<!--header -->
			<header>
			       
				<div id="Fecha_Reloj"></div>
</div>

<?
}
public static function PantallaLogin($pagina,$titulo,$mensaje)
	{
?>
<center>
	<form action=<?=$pagina?> enctype="multipart/form-data" method="post">
<table>
  	<tr> 
    	<td colspan="2" align="center">
      		<br><br><br>
      		<font class="Titulos"><strong><?=$titulo?></strong></font><br><br><br></td>
      	</tr>
      	<tr> 
    	<td colspan="2">
      		<font color="#666666" size="-1" face="Arial, Helvetica, sans-serif"> <?=$mensaje?><br></font><br></td>
  	</tr>
  	<TR> 
              <TD align=left width="40%"><strong>Usuario<br>(Carnet Identidad):</strong><br></TD>
              <TD align=left ><br><input name="usuario" type="text" class="ingreso"/ size="30px" required="required"> <br><br></TD>
			 </TR>
             <TR> 
              <TD align=left width="30%"><strong>Contrase&ntilde;a:</strong><br></TD>
              <TD align=left width=*> <input name="password" type="password" class="ingreso"/  size="30px" required="required"></TD>
            </TR>
            <TR> 
              <TD>&nbsp;</TD>
              <TD>&nbsp;</TD>
            </TR>
            <tr> 
               <td colspan="2" align="center" > 
                  <input type="submit" value="Entrar" class="button"  />
       </td>
            </tr>
        </TABLE>
      </form>
<?
	}
}

?>