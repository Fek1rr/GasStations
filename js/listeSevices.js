const container = document.querySelector(".container");

async function ListeServices() {
    try {
        const envoi = await fetch("./php/ls.php");
        if(envoi.error) {
            throw new Error("Erreur lors de la requête fetch");
        }
        const service = await envoi.json();
        if(service.error) {
            container.innerHTML = `<p>Erreur : ${service.error}</p>`;
            return;
        }

        
        // On génère 
        container.innerHTML = service.map(s => `
            <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;">
                <strong>${s.nomServ}</strong> - ${s.descripServ} 
                <a style="color: blue;" href="${s.lienServ}">(${s.lienServ})</a>
            </div>
        `).join('');

    } catch (erreur) {
        console.error(erreur);
        container.innerHTML = "<p>Impossible de charger les données.</p>";
    }


}
ListeServices();