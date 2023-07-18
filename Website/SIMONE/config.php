<?php 

$db_user = "root";
$db_pass = "";
$db_name = "agenzia_entrate_2";

$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8mb4', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);