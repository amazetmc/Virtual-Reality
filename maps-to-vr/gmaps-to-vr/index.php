<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maps -> VR</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.1.0/octicons.min.css">

    <style>
      html, body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
      }
      #map, #pano {
        float: left;
        height: 95%;
        width: 50%;
      }
      #id{
        height: 5%;
      }
    </style>

    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div id="map"></div>
    <div id="pano"></div><Br clear="all">
    <button id="id" type="button" onClick="location.href = 'start.php?id='+$id;" class="btn btn-primary btn-lg btn-block">?????????</button>

    <script src="https://cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
      function initialize() {
      var sv = new google.maps.StreetViewService();
        var start = {lat: 53.4727697, lng: -2.1872528};
        var map = new google.maps.Map(document.getElementById('map'), {
          center: start,
          zoom: 14
        });
        var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('pano'), {
              position: start,
              pov: {
                heading: 0,
                pitch: 10
              }
            });
        map.setStreetView(panorama);

      google.maps.event.addListener(panorama, "visible_changed", function() {
        $id = panorama.getPano();
        document.getElementById('id').innerHTML = "Click to convert to image (" + panorama.getPano() + ")";
      });

      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrNXDwU6k3wT5yAHZe2UmvuwXwzyt7Gvo&signed_in=true&callback=initialize">
    </script>
  </body>
</html>
