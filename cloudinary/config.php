<?php
include("../vendor/autoload.php");
use Cloudinary\Configuration\Configuration;
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$config = Configuration::instance();
$config->cloud->cloudName = $_ENV['CLOUD_NAME'];
$config->cloud->apiKey = $_ENV['API_KEY'];
$config->cloud->apiSecret = $_ENV['API_SECRET'];
$config->url->secure = true;
?>