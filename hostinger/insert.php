<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "hostinger";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$parent = filter_input(INPUT_POST, 'parent', FILTER_VALIDATE_INT);
if (!$parent) {
    exit();
}

$name = $_POST['name'];

if (!isset($name)) {
    exit;
}

$sql = "INSERT INTO category (name, parent)
VALUES ('$name', '$parent')";

$result = $conn->query($sql);

//echo "1";
header('Location: http://localhost/hostinger/');


$conn->close();
