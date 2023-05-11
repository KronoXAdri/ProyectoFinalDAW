function initUserPuntos() {
    const alias = document.querySelector("#aliasUser");
    const spikePoints = document.querySelector("#spikePoints");
    
    const data = JSON.parse(sessionStorage.getItem("usuario"));
    
    alias.textContent = data.alias;
    spikePoints.textContent = data.puntosCompra;
    
}

document.addEventListener("DOMContentLoaded", initUserPuntos)