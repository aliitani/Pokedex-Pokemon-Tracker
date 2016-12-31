<?php

$host='#';
$username = '#';
$password = '#';
$dbname = '#';

$conn = new mysqli($host, $username, $password, $dbname);

if(!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
?>