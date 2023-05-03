import {exit} from "./imports/miHtml.js";

const exitButton = document.querySelector("#exitElement")
const body = document.querySelector("body");

function gestionarExit() {
    body.innerHTML = "";
    body.innerHTML = exit.innerHTML;
    
    const no = document.querySelector(".no");
    const yes = document.querySelector(".yes");
    const title = document.querySelector("#title");

    no.addEventListener("click", gestionarNo);
    yes.addEventListener("click", gestionarSi);
    title.addEventListener("click", recargarPagina);
}

function gestionarNo() {
    window.location="../src/main.html";
}

function gestionarSi() {
    sessionStorage.setItem("usuario", "");
    window.location="../index.html";
}

function recargarPagina() {
    window.location="../src/main.html";
}

exitButton.addEventListener("click", gestionarExit);