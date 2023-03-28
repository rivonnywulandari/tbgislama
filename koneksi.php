<?php
$conn = pg_connect("host= localhost port= 5432 user= postgres password= 1234 dbname=
fasilitasunand"); 
if (!$conn) {
  echo "Belum Konek";
} else {
  echo "Sudah Konek";
}


 ?>
