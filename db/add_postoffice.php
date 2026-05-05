<?php
include 'connection.php';

$name = $_POST['name'];
$zip  = $_POST['zip'];

$conn->query("INSERT INTO riraf_postoffice (name, zip_code) 
              VALUES ('$name','$zip')");

echo "success";