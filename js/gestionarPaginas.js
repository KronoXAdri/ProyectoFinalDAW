const paginas = document.querySelector("#paginas");
const botonIzquierdo = document.querySelector("#BotonIzquierdo");
const botonDerecho = document.querySelector("#BotonDerecho");

let pagActual = 1;
let totalPag;

function initFlechas() {

    const url = "http://localhost/proyectoFinal/api/v1/superSpikes/Shop/Items";

    fetch(url)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            totalPag = Math.ceil(respuesta.total.numTotal / 8);

            paginas.textContent = pagActual + " de " + totalPag;
            botonIzquierdo.style.visibility = "hidden";
            
            if(pagActual == totalPag){
                botonDerecho.style.visibility = "hidden";
            }

            cargarItems();
    }).catch(error => {
        console.error(error);
    });
}

function saltoPagina(e) {
    if(e.currentTarget.id == "BotonIzquierdo"){
        pagActual -= 1;
        cargarItems();

        if (pagActual == 1) {
            botonIzquierdo.removeEventListener("click", saltoPagina);
            botonDerecho.addEventListener("click", saltoPagina);
            botonDerecho.style.visibility = "visible";
            botonIzquierdo.style.visibility = "hidden";

        }
        if(pagActual > 1){
            botonIzquierdo.addEventListener("click", saltoPagina);
            botonIzquierdo.style.visibility = "visible";
            botonDerecho.style.visibility = "visible";
            botonDerecho.addEventListener("click", saltoPagina);
        }
    }
    if(e.currentTarget.id == "BotonDerecho"){
        pagActual += 1;
        cargarItems();
        if(pagActual > 1){
            botonIzquierdo.addEventListener("click", saltoPagina);
            botonIzquierdo.style.visibility = "visible";
        }
        if(pagActual == totalPag){
            botonDerecho.removeEventListener("click", saltoPagina);
            botonDerecho.style.visibility = "hidden";
        }
    }

    paginas.textContent = pagActual + " de " + totalPag;
}


document.addEventListener("DOMContentLoaded", initFlechas)
botonDerecho.addEventListener("click", saltoPagina);



/* GESTION DE CARGA DE ITEMS */

const itemsTienda = document.querySelectorAll(".item-shop-rellenar");
let primerItem;
let numItems = 8;

function cargarItems() {

    primerItem = (pagActual - 1) * numItems;

    const url = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/Items?p=${primerItem}&numItems=${numItems}`;

    fetch(url)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            rellenarItems(respuesta.skins);
    }).catch(error => {
        console.error(error);
    });
}

function rellenarItems(items) {

    let posDiv = 0;
    for (let i = posDiv; i < itemsTienda.length; i++) {
        itemsTienda[i].style.visibility = "visible";
    }
    mostrarItems(posDiv);
    vaciarItemsTienda();

    items.forEach(element => {
        
        const elementoImagen = `<div class="w-75 h-30 d-flex flex-row align-items-center justify-content-center">
                          <img src="../resources/assets/character/${element.nombre}/Animated/Walk1.png" alt="${element.nombre}" class="h-10 w-25" draggable="false">
                          </div>`;

        itemsTienda[posDiv].innerHTML = elementoImagen;

        const elementoTexto = `<div class="w-100 h-3 d-flex align-items-center justify-content-center">
                               <p class="fs-6 no-margin me-3"> ${element.nombre} </p>
                               <p class="fs-6 no-margin ms-3"> ${element.precio} SP </p>
                               </div> `;

        itemsTienda[posDiv].innerHTML += elementoTexto;
        posDiv += 1;
    });

    ocultarItems(posDiv);
}

function vaciarItemsTienda(){
    itemsTienda.forEach(item => item.innerHTML = "");
}

function mostrarItems(posInicial){
    for (let i = posInicial; i < itemsTienda.length; i++) {
        itemsTienda[i].style.visibility = "visible";
    }
}

function ocultarItems(posInicial){
    for (let i = posInicial; i < itemsTienda.length; i++) {
        itemsTienda[i].style.visibility = "hidden";
    }
}



/* INCLUIR ENLACES */

const cookie = document.querySelector(".bannerGalleta");
const idle = document.querySelector(".bannerIddleSlayer");

function irAGalleta() {
    const win = window.open("https://orteil.dashnet.org/cookieclicker/", '_blank');
    win.focus();
}

function irAIdle() {
    const win = window.open("https://idleslayer.com/", '_blank');
    win.focus();
}


cookie.addEventListener("click", irAGalleta);
idle.addEventListener("click", irAIdle);



/* MI SKIN QUIPADA */
const miSkin = document.querySelector(".my-skin");

function cargarMiSKin() {
    const datosSesion = JSON.parse(sessionStorage.getItem("usuario")).usuario;
    console.log(datosSesion);

    const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/UserSkinEquiped?correo=${datosSesion.correo}`;

    fetch(urlSkin)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            rellenarSkinEquipada(respuesta.skinEquipada);
    }).catch(error => {
        console.error(error);
    });
}

function rellenarSkinEquipada(skin) {
    const textoEquipado = `<div class="w-100 h-3 d-flex align-items-center justify-content-center texto-centro mt-5">
            <p class="fs-5 no-margin"> SKIN EQUIPADA</p>
            </div> `;

    miSkin.innerHTML = textoEquipado;

    const elementoImagen = `<div class="w-100 h-30 d-flex flex-row align-items-center justify-content-center">
    <img src="../resources/assets/character/${skin.nombre}/Animated/Walk1.png" alt="${skin.nombre}" class="h-40 w-50" draggable="false">
    </div>`;

    miSkin.innerHTML += elementoImagen;

    const elementoTexto = `<div class="w-100 h-3 d-flex align-items-center justify-content-center">
            <p class="fs-6 no-margin"> ${skin.nombre} </p>
            </div> `;

    miSkin.innerHTML += elementoTexto;
}


document.addEventListener("DOMContentLoaded", cargarMiSKin);