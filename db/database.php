<?php
   $conn = mysqli_connect("localhost", "root", "", "rutas_turisticas")
      or die (mysqli_error($conn));
   mysqli_set_charset($conn, "UTF8");
?>