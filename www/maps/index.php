<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Turismo La Paz </title>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi"/>
    <link rel="stylesheet" type="text/css" href="../css/index.css"/>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link
        rel="stylesheet"
        href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script
        src="../js/bootstrap.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 100%;
        }
    </style>
    <script async defer
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDW2Uv6f7PSyo2O_GOAzlJqJbG-eaCiTMc&signed_in=true&callback=initMap"></script>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js">
    </script>
    <script  async="async">
        var map;
        var longitud;
        var latitud;
        var localizaciones = [];
        var infowindow;
        var currentInfoWindow = null;
        var markerArrays = [];
        var mc;
        $.ajax({
            type: "GET",
            url: "http://turismolapaz.esy.es/config/maps.class.php?metodo=Locacion&IdLocacion=1",
            async: true,

            success: function (datos) {
                var dataJson = eval(datos);
                for (var i in dataJson) {
                    latitud = dataJson[i].latitud;
                    longitud = dataJson[i].longitud;
                }
                initMap(latitud, longitud);
            },
            error: function (obj, error, objError) {
            }
        });
        $.ajax({
            type: "GET",
            url: "http://turismolapaz.esy.es/config/maps.class.php?metodo=PtsIntrs&IdLocacion=1",
            async: true,
            success: function (datos) {
                var dataJson = eval(datos);
                for (var i in dataJson) {
                    localizaciones.push([dataJson[i].id,
                        dataJson[i].nombre,
                        dataJson[i].descripcion,
                        dataJson[i].tipo_punto,
                        dataJson[i].telefono1,
                        dataJson[i].telefono2,
                        dataJson[i].direccion,
                        dataJson[i].puntaje,
                        dataJson[i].latitud,
                        dataJson[i].longitud,
                        "marker.png"
                    ]);
                }
                setMarkers(map, localizaciones);
            },
            error: function (obj, error, objError) {
                //avisar que ocurrió un error
            }
        });


    </script>
</head>
<body>
<nav class="navbar navbar-inverse" style="margin-bottom: 0px">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.html">Turistic App La Paz</a>
        </div>
    </div>
</nav>
<div id="map"></div>
<script>
    initMap = function (latitude, longitude) {
        var myOptions = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 10,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            navigationControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map'), myOptions);

        var clusterStyles = [
            {
                textColor: 'white',
                text: 'Coroico',
                url: '../img/cluster-mini.png',
                height: 56,
                width: 55
            },
            {
                textColor: 'white',
                url: '../img/cluster-medium.png',
                height: 77,
                width: 78
            },
            {
                textColor: 'white',
                url: '../img/cluster-large.png',
                height: 89,
                width: 90
            }
        ];
        var mcOptions = {
            text: "Coroico",
            gridSize: 500,
            maxZoom: 11,
            styles: clusterStyles
        };
        mc = new MarkerClusterer(map, [], mcOptions);

        google.maps.event.addListener(map, 'click', function () {
            if (currentInfoWindow != null)
                currentInfoWindow.close();
        });
    }
    setMarkers = function (map, arrayMarkers) {
        for (var i = 0; i < arrayMarkers.length; i++) {
            var markers = arrayMarkers[i];
            var image = {
                url: '../img/'+markers[10],
                size: new google.maps.Size(20, 32),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
            };
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[8], markers[9]),
                map: map,
                icon: image,
                zIndex: Math.round(markers[8] * -1000000) << 5,
                title: markers[1]
            });
            contentString = "<h1>Hello World</h1>";
            marker.infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            //add click event
            google.maps.event.addListener(marker, 'click', function () {
                if (currentInfoWindow != null) {
                    currentInfoWindow.close();
                }
                this.infowindow.open(map, this);
                currentInfoWindow = this.infowindow;
            });
            markerArrays.push(marker);
        }
        mc.addMarkers(markerArrays, true);
    }

</script>
</body>
</html>
