<?php


$host = "mysql";
$dbname = "mydatabase";
$username = "myuser";
$password = "mypassword";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;


$connection = new \MongoDB\Client("mongodb://root:password@mongo:27017");
$collection = $mongo->mydatabase->mycollection;
$result = $collection->insertOne('');

