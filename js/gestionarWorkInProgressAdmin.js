const botones = document.querySelectorAll(".work-in-progress");

function gestionarNotFound() {
    window.location="../src/workInProgressAdmin.html";
}

botones.forEach(boton=>boton.addEventListener("click", gestionarNotFound));

