<?php
$conn = new mysqli("localhost", "root", "", "gas");

if ($conn->connect_error) {
    die(json_encode(["error" => "Échec connexion : " . $conn->connect_error]));
}

$conn->set_charset("utf8mb4");
?>