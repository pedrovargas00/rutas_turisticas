<?php
   require("../vendor/autoload.php");

   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
   
   echo $_ENV['API_KEY'].PHP_EOL;
?>