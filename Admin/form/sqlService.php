<?php
header('Content-Type: application/json');
require("./db.php");

$response = ["status" => "error", "message" => "Données incomplètes."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idStat = $_POST['station'] ?? '';
    $nom    = $_POST['service'] ?? '';
    $desc   = $_POST['descrip'] ?? '';

    if (!empty($idStat) && !empty($nom) && !empty($desc)) {
        // Préparation de la requête pour éviter les injections SQL
        $sql = $conn->prepare("INSERT INTO services (nomServ, descripServ, FkStat) VALUES (?, ?, ?)");
        $sql->bind_param("ssi", $nom, $desc, $idStat);

        if ($sql->execute()) {
            $response = ["status" => "success", "message" => "Service enregistré !"];
        } else {
            $response["message"] = "Erreur SQL : " . $conn->error;
        }
        $sql->close();
    }
}

echo json_encode($response);