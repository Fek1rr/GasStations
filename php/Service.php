<?php
require_once("db.php");

if($conn->connect_error) {
    echo "Erreur de connexion ".$conn->connect_error;
    $conn->close();
    exit();
}

$service = $conn->prepare("SELECT nomServ, descripServ, lienServ FROM services");

try {
    $service->execute();
    $resultat = $service->get_result();
    
    if($resultat->num_rows == 0) { 
        throw new Exception("Aucun résultat trouvé");
    }
    
    $data = []; // Initialiser le tableau
    // Parcours des données
    while($row = $resultat->fetch_assoc()){
        $struc = $row['nomServ']." ".$row['descripServ']." ".$row['lienServ'];
        $data[] = $struc;
    }
    //fermer
    $resultat->close();
    $service->close();
    
    // Retourne le tableau de données EN JSON
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}
catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    return []; // en cas d'erreur
}
?>