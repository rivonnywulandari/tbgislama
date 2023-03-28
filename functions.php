<?php
//koneksi ke database
$conn = pg_connect("host= localhost port= 5432 user= postgres password= 1234 dbname=
fasilitasunand"); 

function query($query){
    global $conn;
    $result = pg_query($conn, $query);
    $rows = [];
    while( $row = pg_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah_poin($data){
    global $conn;

    $id = $data['id'];
    $geom = $data['info'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $deskripsi = $data['deskripsi'];
    $gambar = $data['gambar'];

    $query = "INSERT INTO data
    VALUES 
    ('', '$poin')";
    pg_query($conn, $query);

    return pg_affected_rows($conn);
}


?>