<?php
//sesuaikan dengan konfigurasi database masing-masing
$conn = pg_connect("host= localhost port= 5432 user= postgres password= 1234 dbname=
fasilitasunand"); 

//land
$sql = "SELECT
id,
nama, alamat, deskripsi, gambar,
ST_AsGeoJSON(the_geom) AS geometry,
ST_Y(ST_CENTROID(the_geom)) AS lat,
ST_X(ST_CENTROID(the_geom)) AS lng

FROM data"; //sesuaikan dengan field dan database masing-masing
$result = pg_query($sql);
$hasil = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);

while ($isinya = pg_fetch_assoc($result)) {
	$features = array(
		'type' => 'Feature',
		'geometry' => json_decode($isinya['geometry']),
		'properties' => array(
			'id' => $isinya['id'],
			'nama' => $isinya['nama'],
			'alamat' => $isinya['alamat'],
			'deskripsi' => $isinya['deskripsi'],
			'gambar' => $isinya['gambar'],
            'center'=> array(
                'lat'=> $isinya['lat'],
                'lng'=> $isinya['lng']
                )
                
			)
		);
	array_push($hasil['features'], $features);
}
echo json_encode($hasil);
