<script>

    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
    // to the base of the flagpole.
    var longitud;
    var latitud;
    var localizaciones = [];
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
                    dataJson[i].longitud
                ]);
            }
        },
        error: function (obj, error, objError) {
            //avisar que ocurrió un error
        }
    });
    function initMap() {
        var myOptions = {
            center: new google.maps.LatLng(latitud, longitud),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map'), myOptions);

        setMarkers(map);
    }

    function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
            url: '../img/marker.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(37, 37),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(18, 37)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: 'poly'
        };
        for (var i = 0; i < localizaciones.length; i++) {
            var markers = localizaciones[i];
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(markers[8], markers[9]),
                map: map,
                icon: image,
                shape: shape,
                title: markers[1]
            });
        }
    }

</script>
<script async defer
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDW2Uv6f7PSyo2O_GOAzlJqJbG-eaCiTMc&signed_in=true&callback=initMap"></script>