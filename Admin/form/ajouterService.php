<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h4 class="card-title mb-4">Ajouter un Service</h4>
                
                <div id="message"></div>

                <form id="serviceForm">
                    <div class="mb-3">
                        <label class="form-label">Station</label>
                        <select class="form-select" name="station" required>
                            <option value="">Choisir une station...</option>
                            <?php
                            require("./db.php");
                            $resultat = $conn->query("SELECT idStat, nomStat, localStat FROM station ORDER BY nomStat");
                            while($row = $resultat->fetch_assoc()) {
                                echo "<option value='{$row['idStat']}'>{$row['nomStat']} ({$row['localStat']})</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nom du service</label>
                        <input type="text" class="form-control" name="service" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="descrip" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('serviceForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const messageDiv = document.getElementById("message");
            const formData = new FormData(this);

            try {
                const response = await fetch("sqlService.php", {
                    method: "POST",
                    body: formData
                });
               const result = await response.json();
               console.log("Réponse brute du serveur :", result);

                // Affichage du message Bootstrap (Succès ou Erreur)
                const alertClass = result.status === "success" ? "alert-success" : "alert-danger";
                messageDiv.innerHTML = `<div class="alert ${alertClass}">${result.message}</div>`;

                if (result.status === "success") this.reset();
            } catch (error) {
                messageDiv.innerHTML = `<div class="alert alert-danger">Erreur de connexion.</div>`;
                console.log(error.message);
            }
        });
    </script>
</body>
</html>