<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 0)) ;
else header("Location: ../public/index.php");
?>