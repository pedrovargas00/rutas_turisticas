<?php
include("../db/database.php");

$server = $_SERVER['REQUEST_METHOD'];
if ($server == "POST") 
   $id_usuario = $_REQUEST['id_usuario'];
else
   $id_usuario = 0;
$form = $_REQUEST['formulario'];
$id_ruta = $_REQUEST['id_ruta'];
$calificacion = $_REQUEST['estrellas'];
$comentario = $_REQUEST['comentario'];

$result = mysqli_query($conn, "INSERT INTO comentario (id_ruta, id_usuario, comentario, calificacion)
   VALUES ('$id_ruta', '$id_usuario', '$comentario', '$calificacion');")
   or die (mysqli_error($conn));

if ($form == "formPrincipal") {
   header("Location: ../public/mostrar_ruta.php?resultado=$id_ruta");
}
if ($form == "formUsuario") {
   header("Location: ../public/usuario/mostrar_ruta.php?resultado=$id_ruta");
}
?>