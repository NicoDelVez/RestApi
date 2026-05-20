//funzione asincrona che gli viene passato il volore dei bottoni
async function chiamaAPI(tipo) {
    //prendi il volre del display
    const display = document.getElementById('display');

    try {
        const url = `api.php/${tipo}`;
        const risposta = await fetch(url);
        
        if (!risposta.ok) {
            throw new Error(`Errore Server: ${risposta.status}`);
        }

        const dati = await risposta.json();

        display.innerHTML = `<h3>Risultati per: ${tipo}</h3>`;
        
        //foreach per scrivere la squadra nel frontend
        dati.forEach(squadra => {
            display.innerHTML += `
                <div class="squadra">
                    <strong>${squadra.nome}</strong><br>
                    <small>Città: ${squadra.citta}</small><br>
                    Trofei vinti: ${squadra.trofei} 
                </div>
            `;
        });
    } catch (err) {
        display.innerHTML = `
            <div style="color:red;">
                Errore nella chiamata al Web Service.<br>
                <small>${err.message}</small>
            </div>
        `;
    }
}

