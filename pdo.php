<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "clothing";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("failed to connect");
}