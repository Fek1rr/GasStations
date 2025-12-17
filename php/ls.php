<?php
header('Content-Type: application/json');
require("./db.php");

$sql = "SELECT nomServ, descripServ, lienServ From services";
$resultat = $conn->query($sql);

if ($resultat) {
    $data = $resultat->fetch_all(MYSQLI_ASSOC); // recupère toutes les données
    echo json_encode($data); 
} else {
    echo json_encode(["error" => "Erreur SQL"]);
}

$conn->close();
?>