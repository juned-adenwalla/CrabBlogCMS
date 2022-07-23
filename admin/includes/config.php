<?php

$path = __DIR__ .'/../../config.json';
$get_config = file_get_contents($path);
$json_data = json_decode($get_config, true);

$db_host = $json_data["db_server"];
$db_user = $json_data["db_username"];
$db_password = $json_data["db_password"];
$db_name = $json_data["db_name"];

$con = mysqli_connect($db_host, $db_user, $db_password, $db_name);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>