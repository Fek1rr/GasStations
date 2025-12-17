<?php
header('Content-Type: application/json');
require("./db.php");

$response = ["status" => "error", "message" => "Données incomplètes."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commune = $_POST['commune'] ?? '';
    $nom  = $_POST['station'] ?? '';
    $local = $_POST['local'] ?? '';

    if (!empty($commune) && !empty($nom) && !empty($local)) {
        // Préparation de la requête 
        $sql = $conn->prepare("INSERT INTO station (nomStat, localStat, FkCom) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $nom, $local, $commune);

        if ($sql->execute()) {
            $response = ["status" => "success", "message" => "station enregistré !"];
        } else {
            $response["message"] = "Erreur SQL : " . $conn->error;
        }
        $sql->close();
    }
}

echo json_encode($response);