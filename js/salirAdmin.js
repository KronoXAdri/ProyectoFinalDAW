const salirBoton = document.querySelector("#Salir");

function salir() {
    sessionStorage.setItem("usuario", "");
    window.location="../index.html";
}

salirBoton.addEventListener("click", salir);