<?php
//koneksi
session_start();
require 'functions.php';
include("koneksi.php");

?>



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
                        <div id="map-canvas" style="height: 400px; width: 700px"></div>
                        <h4>Updated Coordinates (X,Y)</h4>
                        <div id="info" style="position:absolute; color:red; font-family: Arial; height:200px; font-size: 12px;"></div>

                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&libraries=drawing"></script>

                        <script>
                            var mapOptions;
                            var map;

                            var coordinates = []
                            let new_coordinates = []
                            let lastElement

                            function InitMap() {
                                var location = new google.maps.LatLng(-0.914813, 100.458801)
                                mapOptions = {
                                    zoom: 11,
                                    center: location,
                                    mapTypeId: google.maps.MapTypeId.RoadMap
                                }
                                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions)
                                var all_overlays = [];
                                var selectedShape;
                                var drawingManager = new google.maps.drawing.DrawingManager({
                                    //drawingMode: google.maps.drawing.OverlayType.MARKER,
                                    //drawingControl: true,
                                    drawingControlOptions: {
                                        position: google.maps.ControlPosition.TOP_CENTER,
                                        drawingModes: [
                                            //google.maps.drawing.OverlayType.MARKER,
                                            //google.maps.drawing.OverlayType.CIRCLE,
                                            google.maps.drawing.OverlayType.POLYGON,
                                            //google.maps.drawing.OverlayType.RECTANGLE
                                        ]
                                    },
                                    markerOptions: {
                                        //icon: 'images/beachflag.png'
                                    },
                                    circleOptions: {
                                        fillColor: '#ffff00',
                                        fillOpacity: 0.2,
                                        strokeWeight: 3,
                                        clickable: false,
                                        editable: true,
                                        zIndex: 1
                                    },
                                    polygonOptions: {
                                        clickable: true,
                                        draggable: false,
                                        editable: true,
                                        // fillColor: '#ffff00',
                                        fillColor: '#ADFF2F',
                                        fillOpacity: 0.5,

                                    },
                                    rectangleOptions: {
                                        clickable: true,
                                        draggable: true,
                                        editable: true,
                                        fillColor: '#ffff00',
                                        fillOpacity: 0.5,
                                    }
                                });

                                function clearSelection() {
                                    if (selectedShape) {
                                        selectedShape.setEditable(false);
                                        selectedShape = null;
                                    }
                                }
                                //to disable drawing tools
                                function stopDrawing() {
                                    drawingManager.setMap(null);
                                }

                                function setSelection(shape) {
                                    clearSelection();
                                    stopDrawing()
                                    selectedShape = shape;
                                    shape.setEditable(true);
                                }

                                function deleteSelectedShape() {
                                    if (selectedShape) {
                                        selectedShape.setMap(null);
                                        drawingManager.setMap(map);
                                        coordinates.splice(0, coordinates.length)
                                        document.getElementById('info').innerHTML = ""
                                    }
                                }

                                function CenterControl(controlDiv, map) {

                                    // Set CSS for the control border.
                                    var controlUI = document.createElement('div');
                                    controlUI.style.backgroundColor = '#fff';
                                    controlUI.style.border = '2px solid #fff';
                                    controlUI.style.borderRadius = '3px';
                                    controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
                                    controlUI.style.cursor = 'pointer';
                                    controlUI.style.marginBottom = '22px';
                                    controlUI.style.textAlign = 'center';
                                    controlUI.title = 'Select to delete the shape';
                                    controlDiv.appendChild(controlUI);

                                    // Set CSS for the control interior.
                                    var controlText = document.createElement('div');
                                    controlText.style.color = 'rgb(25,25,25)';
                                    controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
                                    controlText.style.fontSize = '16px';
                                    controlText.style.lineHeight = '38px';
                                    controlText.style.paddingLeft = '5px';
                                    controlText.style.paddingRight = '5px';
                                    controlText.innerHTML = 'Delete Selected Area';
                                    controlUI.appendChild(controlText);

                                    //to delete the polygon
                                    controlUI.addEventListener('click', function() {
                                        deleteSelectedShape();
                                    });
                                }

                                drawingManager.setMap(map);

                                var getPolygonCoords = function(newShape) {

                                    coordinates.splice(0, coordinates.length)

                                    var len = newShape.getPath().getLength();

                                    for (var i = 0; i < len; i++) {
                                        coordinates.push(newShape.getPath().getAt(i).toUrlValue(6))
                                    }
                                    document.getElementById('info').innerHTML = coordinates


                                }

                                google.maps.event.addListener(drawingManager, 'polygoncomplete', function(event) {
                                    event.getPath().getLength();
                                    google.maps.event.addListener(event, "dragend", getPolygonCoords(event));

                                    google.maps.event.addListener(event.getPath(), 'insert_at', function() {
                                        getPolygonCoords(event)

                                    });

                                    google.maps.event.addListener(event.getPath(), 'set_at', function() {
                                        getPolygonCoords(event)
                                    })
                                })

                                google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                                    all_overlays.push(event);
                                    if (event.type !== google.maps.drawing.OverlayType.MARKER) {
                                        drawingManager.setDrawingMode(null);

                                        var newShape = event.overlay;
                                        newShape.type = event.type;
                                        google.maps.event.addListener(newShape, 'click', function() {
                                            setSelection(newShape);
                                        });
                                        setSelection(newShape);
                                    }
                                })

                                var centerControlDiv = document.createElement('div');
                                var centerControl = new CenterControl(centerControlDiv, map);


                                centerControlDiv.index = 1;
                                map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);

                            }

                            InitMap()
                            // 
                            </script>
                        <br>
                        <form class="form" action="pointambah.php" method="post">

                            <div class="form-group">
                                <label for="inputAddress">id</label>
                                <input type="text" class="form-control" id="id">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Nama Bangunan</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Alamat</label>
                                <input type="text" class="form-control" id="alamat">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Gambar</label>
                                <input type="text" class="form-control" id="gambar" placeholder="img/6.jpg">
                            </div>


                            <div class="form-group">
                                <div class="form-check">

                                </div>
                            </div>
                            <input class="btn btn-success" type="submit" name="simpan" value="Tambahkan">


                        </form>
                        
                        <?php

                        if (isset($_POST["simpan"])) {

                            if (tambah_poin($_POST) > 0) {
                                echo "
                            <script>
                                alert('data berhasil ditambahkan!');
                                document.location.href = 'poin.php';
                                </script>";
                            } else {
                                echo "
                            <script>
                                alert('data gagal ditambahkan!');
                                document.location.href = 'poin.php';
                                </script>";
                            }
                        }

                        ?>

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