<?php

include "vendor/autoload.php";
include "config/database.php";

use Models\Connection;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views')
]);

$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;