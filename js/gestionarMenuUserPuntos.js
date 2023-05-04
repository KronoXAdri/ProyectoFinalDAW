const alias = document.querySelector("#aliasUser");
const spikePoints = document.querySelector("#spikePoints");

const data = JSON.parse(sessionStorage.getItem("usuario"));

alias.textContent = data.usuario.alias;
spikePoints.textContent = data.usuario.puntosCompra;