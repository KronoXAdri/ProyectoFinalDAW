const paginas = document.querySelector("#paginas");
const botonIzquierdo = document.querySelector("#BotonIzquierdo");
const botonDerecho = document.querySelector("#BotonDerecho");

let pagActual = 1;
let totalPag = 4;

paginas.textContent = pagActual + " de " + totalPag;
botonIzquierdo.style.visibility = "hidden";

function saltoPagina(e) {
    if(e.currentTarget.id == "BotonIzquierdo"){
        pagActual -= 1;
        if (pagActual == 1) {
            botonIzquierdo.removeEventListener("click", saltoPagina);
            setTimeout(() => 
            botonIzquierdo.style.visibility = "hidden",600);
        }
        if(pagActual > 1){
            botonIzquierdo.addEventListener("click", saltoPagina);
            botonDerecho.style.visibility = "visible";
            botonDerecho.addEventListener("click", saltoPagina);
        }
        if(pagActual == totalPag){
            botonDerecho.removeEventListener("click", saltoPagina);
            setTimeout(() => 
            botonIzquierdo.style.visibility = "hidden",600);
        }

    }
    if(e.currentTarget.id == "BotonDerecho"){
        pagActual += 1;
        if(pagActual > 1){
            botonIzquierdo.addEventListener("click", saltoPagina);
            botonIzquierdo.style.visibility = "visible";
        }
        if(pagActual == totalPag){
            botonDerecho.removeEventListener("click", saltoPagina);
            setTimeout(() => 
            botonDerecho.style.visibility = "hidden",600);
        }
    }

    paginas.textContent = pagActual + " de " + totalPag;
}



botonDerecho.addEventListener("click", saltoPagina);