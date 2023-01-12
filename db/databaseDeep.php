
<?php
   require("../../vendor/autoload.php");

   $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
   $dotenv->load();

   $conn = mysqli_connect($_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_TABLE'])
      or die (mysqli_error($conn));
   mysqli_set_charset($conn, "UTF8");
?>