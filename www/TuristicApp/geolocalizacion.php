<?
require('php_lib/restringir_acceso.php'); 
?><!DOCTYPE html>
<html>
  <head>
    <title>Monitoreo</title>
    
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-y: hidden;
      }
      #mapa {
        height: 100%;
        z-index: 1;
      }
      .link{
position:absolute;
float:left;
font-family:arial;
color:#1D6327;
text-decoration:none;
width:100%;
height:55px;
text-align:left;
}
.button1 {position:relative;
top:-600px;
left:10px;
z-index:3;
display:inline-block;
font-size:22px;
color:#fff;
background:#5E9EA1 0; heigth:65px;line-height:44px;position:relative;border-radius:4px;-moz-border-radius:4px;
-webkit-border-radius:4px;letter-spacing:-1px;margin-top:-4px}
.button1:hover {background:#7fd1d6;color:#FFF}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDW2Uv6f7PSyo2O_GOAzlJqJbG-eaCiTMc&signed_in=true&sensor=true&callback=initMap">
    </script>
    <script type="text/javascript">
<?if($_GET["lat"]!=null) 
	{
?>
var Path= [];
$.ajax({
        type: "POST",
        url:"php_lib/reg_viaje.php?a=b&ci=<?echo $_GET["ci"];?>",
        async: true,
        success: function(datos){
            var dataJson = eval(datos);
            for(var i in dataJson){
            	Path[i]=new google.maps.LatLng(dataJson[i].lat, dataJson[i].lng);
            	     
         }
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
});
 var marker = null;
 
      function funcionClick() {
        if (marker.getAnimation() != null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
 
      function inicializar_mapa() {
        var mapOptions = {
          center: new google.maps.LatLng(<?echo $_GET["lat"];?>, <?echo $_GET["lon"];?>),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("mapa"),
            mapOptions);
 
        var pos = new google.maps.LatLng(<?echo $_GET["lat"];?>, <?echo $_GET["lon"];?>);
 
        marker = new google.maps.Marker({
            position: pos,
            map: map,
            title:"Ultima ubicacion: <?echo $_GET["dato"];?>",
            animation: google.maps.Animation.DROP
        }); 
 
        marker.setIcon('https://dl.dropboxusercontent.com/u/20056281/Iconos/male-2.png');
        google.maps.event.addListener(marker, 'click', funcionClick);
        
        
      

  var Ruta = new google.maps.Polyline({
    path: Path,
    geodesic: true,
    strokeColor: '#222000', 
    strokeWeight: 4,  
    strokeOpacity: 0.6, 
    clickable: true 
  });

  Ruta.setMap(map);
 
      }
      google.maps.event.addDomListener(window, 'load', inicializar_mapa); 
<? }
	
			 else
			 {?>
			 	
    function popitup(data) {
    url="enc_tra_r.php?id="+data;
	newwindow=window.open(url,'Informacion Viaje','location=0,menubar=0,resizable=0,status=1,scrollbars=0,titlebar=0,toolbar=0,directories=0,left=450px, top=100px, height=550,width=400');
	if (window.focus) {newwindow.focus()}
	return false;
}

var map;
var posicion = [];
var marcadores = [['Omar'],[0],[0]];
var localizaciones = [[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]];
 $.ajax({
        type: "GET",
        url:"php_lib/reg_viaje.php?a=a",
        async: true,
        success: function(datos){
            var dataJson = eval(datos);
            for(var i in dataJson){
            	localizaciones[i][0]=dataJson[i].id;
            	localizaciones[i][1]=dataJson[i].lat;
            	localizaciones[i][2]=dataJson[i].lng; 
            	localizaciones[i][3]=dataJson[i].n; 
            	localizaciones[i][4]=dataJson[i].d; 
            	localizaciones[i][5]=dataJson[i].p; 
            	localizaciones[i][6]=dataJson[i].size; 
               }
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
});

function inicializar_mapa() {
 	var mapOptions = {
          center: new google.maps.LatLng(-16.1336749, -67.3381175),
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
      map = new google.maps.Map(document.getElementById('mapa'), 
      mapOptions);
  for (var i=0; localizaciones.length; i++)
  {
  	if (localizaciones[i][6]==300)
  	{var color="#01DF01";}
  	else
  	{var color="#000";}
    var radioa = new google.maps.Circle({
      strokeColor: color,
      strokeOpacity: 0.8,
      strokeWeight: 2,
      title: localizaciones[i][3]+"<br>"+localizaciones[i][4],
      fillColor: color,
       fillOpacity: 0.35,
      center: new google.maps.LatLng(localizaciones[i][1], localizaciones[i][2]),
      radius: parseInt(localizaciones[i][6])*3,
      map: map
    });
     var info= new google.maps.InfoWindow();

//add a click event to the circle
google.maps.event.addListener(radioa, 'click', (function(radioa, i) {
          return function() {
            info.setContent("<div>Visualizar información<br>del viaje <a class='link' href=# onclick='return popitup("+localizaciones [i][0]+")'>AQUI</a>.<br>&nbsp;</div>");
            info.setPosition(radioa.getCenter());
            info.open(map, radioa);
          }
        })(radioa, i));
   } 
   
     }
    
    
$.ajax({
        type: "POST",
        url:"php_lib/reg_viaje.php",
        async: true,
        success: function(datos){
            var dataJson = eval(datos);
            for(var i in dataJson){
            	var lalo=dataJson[i].lat+", "+dataJson[i].lng;
            	marcadores[i][0]=dataJson[i].id;
            	marcadores[i][1]=dataJson[i].lat;
            	marcadores[i][2]=dataJson[i].lng;     
         }
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
});
 
     function markers(){
     	for (var i = 0; i < posicion.length; i++)
     	{
     		posicion[i].setMap(null);
     	}
     	$.ajax({
        type: "POST",
        url:"php_lib/reg_viaje.php",
        async: true,
        success: function(datos){
            var dataJson = eval(datos);
            for(var i in dataJson){
            	var lalo=dataJson[i].lat+", "+dataJson[i].lng;
            	marcadores[i][0]=dataJson[i].id;
            	marcadores[i][1]=dataJson[i].lat;
            	marcadores[i][2]=dataJson[i].lng;     
         }
        },
        error: function (obj, error, objError){
            //avisar que ocurrió un error
        }
});
 
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map,
          title: "CODIGO DE VIAJE: "+marcadores[i][0]
        });
        posicion.push(marker);
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent("<div>Visualizar información<br>del viaje <a class='link' href=# onclick='return popitup("+marcadores[i][0]+")'>AQUI</a>.<br>&nbsp;</div>");
            infowindow.open(map, marker);
          }
        })(marker, i));
        posicion.push(marker);
        marker.setIcon('http://fuerteguide.com/images/categories/m_t_bus.png');
        }
       }
var refresca= window.setInterval(markers, 5000);
google.maps.event.addDomListener(window, 'load', inicializar_mapa); 
<?}?>
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDW2Uv6f7PSyo2O_GOAzlJqJbG-eaCiTMc&signed_in=true&callback=initMap" async defer></script>
</head>
  <body>
  	<div id="mapa"></div>
  	<?
  	if ($_GET["cod"]==1)
  	{
  		?><input type="button" class="button1" onclick= location.href='enc_tra.php' value="VOLVER" /><? 
  	}
  	else
  	{?>
       <input type="button" class="button1" onclick= location.href='adm_tra.php' value="VOLVER" /> 
    <?}?>
    </body>
</html>