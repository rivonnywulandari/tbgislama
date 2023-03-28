<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">TB OR LABGIS</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <!-- Untuk memeriksa GeoJSON                                         -->
                        <a class="nav-link" href="http://localhost:8080/tbgislama/webserver/data.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data GeoJSON
                        </a>            
                        <!-- Untuk menambah objek maps                                         -->
                        <a class="nav-link" href="http://localhost:8080/tbgislama/webserver/geomap.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            CRUD Maps
                        </a>
                        <a class="nav-link" href="http://localhost:8080/tbgislama/tambah.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tambah Maps
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-3"></h1>
                    <div class="row">
                    </div>
                    <div class="row">
                    </div>
                    <div>

                        <!-- CODINGAN MAP -->
                        <html lang="en">

                        <head>

                            <meta charset="utf-8">
                            <title>TB OR GIS</title>
                            <style>
                                #map {
                                    height: 100%;
                                }

                                /* Optional: Makes the sample page fill the window. */
                                html,
                                body {
                                    height: 100%;
                                    margin-top: 0;
                                    padding: 0;
                                }
                            </style>
                            <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

                            <div id="map_canvas" style="width: 100%; height: 600px;"></div>

                            <!-- Google Maps API -->
                            <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1TwYksj1uQg1V_5yPUZqwqYYtUIvidrY&callback=basemap"></script> -->

                            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&callback=basemap"></script>
                            <!-- jQuery -->
                            <script src="js/jquery.js"></script>

                            <!-- Bootstrap Core JavaScript -->
                            <script src="js/bootstrap.min.js"></script>

                            <!-- Plugin JavaScript -->
                            <script src="js/jquery.easing.min.js"></script>

                            <!--Fancybox-->
                            <script type="text/javascript" src="fancy/jquery.mousewheel-3.0.6.pack.js"></script> <!-- Sertakan JQuery mousewheel untuk image gallery!-->
                            <script type="text/javascript" src="fancy/source/jquery.fancybox.js?v=2.1.5"></script> <!-- Sertakan JQuery fancybox dan cssnya-->
                            <link rel="stylesheet" type="text/css" href="fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />

                            <script type="text/javascript">
                                var infowindow;
                                var geomarker;
                                var markerarray = [];
                                var map;
                                var objek;
                                var directionsService;
                                var directionDisplay;
                                var usegeolocation;
                                var server = 'http://localhost:8080/tbgislama/webserver/';
                                // var client='http://localhost/tbgis/webclient/';
                                var markerarraygeo = [];
                                var circlearray = [];
                                var layernya;

                                function initialize() {
                                    geolocation();
                                    basemap();
                                }

                                function basemap() {
                                    google.maps.visualRefresh = true;
                                    map = new google.maps.Map(document.getElementById('map_canvas'), {
                                        zoom: 11,
                                        center: new google.maps.LatLng(-0.914813, 100.458801),
                                        mapTypeId: google.maps.MapTypeId.HYBRID
                                    });
                                    loadLayer();
                                };

                                function loadLayer() {
                                    layernya = new google.maps.Data();
                                    layernya.loadGeoJson(server + 'data.php');
                                    layernya.setMap(map);
                                }


                                // Panggil data geojson yg ada di file data.php
                                $.ajax({
                                    url: server + 'data.php',
                                    dataType: 'json',
                                    cache: false,
                                    success: function(results) {
                                        for (var i = 0; i < results.features.length; i++) {
                                            var data = results.features[i];
                                            var coords = data.geometry.coordinates;
                                            var id = data.properties.id;
                                            var nama = data.properties.nama;
                                            var alamat = data.properties.alamat;
                                            var deskripsi = data.properties.deskripsi;
                                            var titiktengah = data.properties.center
                                            var latitude = titiktengah.lat;
                                            var longitude = titiktengah.lng;
                                            var latLng = new google.maps.LatLng(latitude, longitude);
                                            var gambar = data.properties.gambar; //menmpilkan informasi pada pencarian

                                            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
                                            var marker = new google.maps.Marker({
                                                position: latLng,
                                                map: map,
                                                animation: google.maps.Animation.DROP,
                                                icon: 'markerbaru.png',
                                                title: nama
                                                //shadow: iconBase + 'schools_maps.shadow.png'
                                            });

                                            markerarray.push(marker); //menampilkan informasi pada marking
                                            var isiinfo = "<div style='width:300px; min-height:100px;'><b><h2><center>" + nama + "</center></h2></b><center><img src='" + server + "/" + gambar + "' style='width:100%;'></center><br><center><p>" + alamat + "</p></center></div>";
                                            createInfoWindow(marker, isiinfo);
                                            map.setCenter(titiktengah);
                                        }
                                    }


                                });
                                var infowindow = new google.maps.InfoWindow();

                                function createInfoWindow(marker, isiinfo) {
                                    google.maps.event.addListener(marker, 'click', function() {
                                        infowindow.setContent(isiinfo);
                                        infowindow.open(map, this);
                                    });
                                }
                                google.maps.event.addDomListener(window, 'load', initialize);


                                function clearmarkergeo() {
                                    for (var i = 0; i < markerarraygeo.length; i++) {
                                        markerarraygeo[i].setMap(null);
                                    }
                                    markerarraygeo = [];
                                }

                                function clearmarker() {
                                    for (var i = 0; i < markerarray.length; i++) {
                                        markerarray[i].setMap(null);
                                    }
                                    markerarray = [];
                                }

                                function geolocation() {
                                    navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError);
                                }

                                function geolocationSuccess(posisi) {
                                    var pos = new google.maps.LatLng(posisi.coords.latitude, posisi.coords.longitude);
                                    //   var image = 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Ball-Pink-icon.png';
                                    geomarker = new google.maps.Marker({
                                        map: map,
                                        position: pos,
                                        icon: 'markerdisini.png',
                                        animation: google.maps.Animation.DROP
                                    });
                                    map.panTo(pos);
                                    infowindow = new google.maps.InfoWindow();
                                    infowindow.setContent('Posisi Anda Sekarang');
                                    infowindow.open(map, geomarker);
                                    usegeolocation = true;
                                }

                                function geolocationError(err) {
                                    usegeolocation = false;

                                }
                            </script>
                            <!-- Footer -->
                            <footer>
                                <div>
                                    <br>
                                    <p align="center">Copyright &copy; LABGIS</p>
                                </div>
                            </footer>

</body>

</html>
<!-- TUTUP CODINGAN MAP -->

</div>
</div>
</main>
<footer class="py-4 bg-light mt-auto">
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>