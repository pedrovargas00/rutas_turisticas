<?php
include("../vendor/autoload.php");
use Cloudinary\Configuration\Configuration;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = Configuration::instance();
$config->cloud->cloudName = $_ENV['CLOUD_NAME'];
$config->cloud->apiKey = $_ENV['API_KEY'];
$config->cloud->apiSecret = $_ENV['API_SECRET'];
$config->url->secure = true;
?>