<?php

require_once("php_lib/interfaz.class.php");
require_once("php_lib/conexion.class.php");
$interfaz=new interfaz();
$interfaz->hacer_cabecera("login");

$result=mysql_query($query);
?><br><br><br><br><br><br><br><br>
<style>

ul
{
margin:0px;
padding:0px;
list-style-type:none;
-webkit-backface-visibility: hidden; backface-visibility: hidden;  
}
.var_nav
{
position:absolute;
background:RGB(0,160,192); 
width:242px;
height:55px;
margin-bottom:1px;
}
.link_bg
{
 width:70px;
 height:55px;
 position:absolute;
 background:RGB(0,92,113);
 color:#000;
 z-index:2;
}
.link_bg i
{
 position:absolute;
}
.link_title
{
position:absolute;
width:100%;
z-index:3;
color:#000;
}
.link_title:hover .icon
{
-webkit-transform:rotate(360deg);
-moz-transform:rotate(360deg);
-o-transform:rotate(360deg);
-ms-transform:rotate(360deg);
transform:rotate(360deg);  
}

/*para el color a cambiar*/
.var_nav:hover .link_bg
{
width:100%;
background:RGB(0,92,113); ;
-webkit-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-ms-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;  
}
.var_nav:hover a
{
font-weight:bold;
-webkit-transition:all .5s ease-in-out;
-moz-transition:all .5s ease-in-out; 
-o-transition:all .5s ease-in-out; 
-ms-transition:all .5s ease-in-out;
 transition:all .5s ease-in-out;  
}
.icon
{
position:absolute;
width:70px;
height:55px;
text-align:center;
/*color de icono*/
color:#fff;
-webkit-transition:all .5s ease-in-out;
-moz-transition:all .5s ease-in-out; 
-o-transition:all .5s ease-in-out; 
-ms-transition:all .5s ease-in-out;   
float:left;
transition:all .5s ease-in-out;   
float:left;  
}
.icon i{top:13px;position:absolute;}

a{
position:absolute;
float:left;
font-family:arial;
color:RGB(0,112,133);
text-decoration:none;
width:100%;
height:55px;
text-align:left;
}
span
{
margin-top:17px;
margin-left:80px;
display:block;
}

.link{
}
</style>
<center><font style="font-size:35px;">BIENVENIDO</font></center>
<div id="login">
	<a href="login.php">
		<table><tr><td>
		<img src="images/user.png" width="24px" height="29px"></td><td><font style="font-size: 18px;"><b>LOGIN</b></font></td></tr></table></a>
</div>
<div id="cuerpo">
	<div class="slider-wrap">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">

				<div class="panel" title="Panel 1">
					<div class="wrapper">
							<table>
							<tr><td width="410px">
						<img src="images/1.jpg" style="border-style:dotted;border-width:1px;width:400px;height:270px"  />
</td><td width="390px">
						<h1>Nuestra Empresa</h1>

						<p>
							Somos una empresa dedicada a la seguridad ciudadana enfocados al monitoreo de personas
							mediante tecnología WEB y Movil
							</p>
		</td></tr>			</table>
						<div class="photo-meta-data">
<!--AQUI DESCRIPCION DE LA FOTO-->
						</div>
					</div>
				</div>
				<div class="panel" title="Panel 2">
					<div class="wrapper">
							<table>
							<tr><td width="410px">
						<img src="images/2.jpg" style="border-style:dotted;border-width:1px;width:400px;height:270px"  />
</td><td width="390px">
						<h1>Mision</h1>

						<p>
							Somos una empresa dedicada a la seguridad ciudadana enfocados al monitoreo de personas
							mediante tecnología WEB y Movil
							</p>
		</td></tr>			</table>
						<div class="photo-meta-data">
			<!--AQUI DESCRIPCION DE LA FOTO-->				
						</div>
					</div>
				</div>
				<div class="panel" title="Panel 3">
					<div class="wrapper">
	<table>
							<tr><td width="410px">
						<img src="images/3.jpg" style="border-style:dotted;border-width:1px;width:400px;height:270px"  />
</td><td width="390px">
						<h1>Vision</h1>

						<p>
							Somos una empresa dedicada a la seguridad ciudadana enfocados al monitoreo de personas
							mediante tecnología WEB y Movil
							</p>
						</ul>
		</td></tr>			</table>
					</div>
				</div>
			</div>
		</div>

		<a href="#1" class="cross-link active-thumb"><img src="images/1.jpg" style="border-style:dotted;border-width:1px;width:80px;height:60px" class="nav-thumb" /></a>
		<div id="movers-row">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div><a href="#2" class="cross-link"><img src="images/2.jpg" class="nav-thumb" style="border-style:dotted;border-width:1px;width:80px;height:60px" /></a></div>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<div><a href="#3" class="cross-link"><img src="images/3.jpg" class="nav-thumb" style="border-style:dotted;border-width:1px;width:80px;height:60px" /></a></div>
			
		</div>
	</div>

</div>
<div class="social">
<table>
	<tr>
		<td height="55px">
<a href="#"><img src="images/fb.png" style="width:50px;height:50px"/></a>
		</td>
	</tr>
	<tr>
		<td height="55px">
<a href="#"><img src="images/tw.png" style="width:50px;height:50px" /></a>
		</td>
	</tr>
	<tr>
		<td height="55px">
<a href="#"><img src="images/yt.png" style="width:50px;height:50px"  /></a>
		</td>
	</tr>
</table>
	</div>
</body>
</html>