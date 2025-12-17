async function chargerStations() {
    const conteneur = document.querySelector(".listestats");

    try {
        // Chemin relatif 
        const reponse = await fetch("./php/ListeStats.php");
        
        if (!reponse.ok) throw new Error("Erreur serveur");

        const stations = await reponse.json();

        if (stations.error) {
            conteneur.innerHTML = `<p>Erreur : ${stations.error}</p>`;
            return;
        }


        // On génère 
        var statut = "";
        conteneur.innerHTML = stations.map(s => `
            <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;">
                <strong>${s.nomStat}</strong> - ${s.localStat} 
                statut = s.statutStat;
                statut = statut == 1 ? "ouverte" : "fermée";
                <span style="color: blue;">(${statut})</span>
            </div>
        `).join('');

    } catch (erreur) {
        console.error(erreur);
        conteneur.innerHTML = "<p>Impossible de charger les données.</p>";
    }
}

chargerStations();