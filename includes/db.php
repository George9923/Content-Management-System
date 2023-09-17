<?php ob_start();

$db['db_host'] = "db";
$db['db_user'] = "root";
$db['db_pass'] = "linuxc";
$db['db_name'] = "cms";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);

$query = "SET NAMES utf8";
mysqli_query($connection, $query);
?>