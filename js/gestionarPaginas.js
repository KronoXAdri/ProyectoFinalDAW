const paginas = document.querySelector("#paginas");
const botonIzquierdo = document.querySelector("#BotonIzquierdo");
const botonDerecho = document.querySelector("#BotonDerecho");

let pagActual = 1;
let totalPag;
let noChecked = false;

function initFlechas() {

    let url = "";

    if(!noChecked){
        url = "http://localhost/proyectoFinal/api/v1/superSpikes/Shop/Items";
    }else{
        const datosSesion = JSON.parse(sessionStorage.getItem("usuario")).usuario;
        url = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/ItemsBougths?correo=${datosSesion.correo}`; 
    }

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

let itemsTienda = document.querySelectorAll(".item-shop-rellenar");
let primerItem;
let numItems = 8;

function initItemsTienda() {
    itemsTienda = document.querySelectorAll(".item-shop-rellenar");
}

function cargarItems() {

    primerItem = (pagActual - 1) * numItems;

    const url = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/Items?p=${primerItem}&numItems=${numItems}`;

    fetch(url)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        if(!noChecked){
            rellenarItems(respuesta.skins);

        }
    }).catch(error => {
        console.error(error);
    });
}

function rellenarItems(items) {

    let posDiv = 0;
    mostrarItems(posDiv);
    vaciarItemsTienda();

    items.forEach(element => {
        
        const elementoImagen = `<div class="w-75 h-30 d-flex flex-row align-items-center justify-content-center">
                          <img src="../resources/assets/character/${element.nombre}/Animated/Walk1.png" alt="${element.nombre}" class="h-10 w-25" draggable="false">
                          </div>`;

        itemsTienda[posDiv].innerHTML = elementoImagen;

        let elementoTexto = "";

        if(itemsTienda[posDiv].classList.contains("div"+(posDiv+1)+"-equipados")){
            elementoTexto = `<div class="w-100 h-3 d-flex align-items-center justify-content-center">
                                <p class="fs-6 no-margin me-3"> ${element.nombre} </p>
                            </div> `;

            elemComprados = document.querySelectorAll(".item-shop-animation-bougths");
            elemComprados.forEach(elem => elem.addEventListener("click", equiparSkin));

        }else{
            elementoTexto = `<div class="w-100 h-3 d-flex align-items-center justify-content-center">
                                <p class="fs-6 no-margin me-3"> ${element.nombre} </p>
                                <p class="fs-6 no-margin ms-3"> ${element.precio} SP </p>
                            </div> `;
        }

        itemsTienda[posDiv].innerHTML += elementoTexto;
        posDiv += 1;
    });

    ocultarItems(posDiv);
}

function equiparSkin(e) {
    let nombreItem = e.currentTarget.children[1].children[0].textContent;
    let datosSesion = JSON.parse(sessionStorage.getItem("usuario")).usuario;

    nombreItem = nombreItem.trimStart();
    nombreItem = nombreItem.trimEnd();
    datosSesion.alias = datosSesion.alias.trimStart();
    datosSesion.alias = datosSesion.alias.trimEnd();

    const body = { 
        method: 'PUT'
    };
    const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/UserSkinEquiped?nombreItem=${nombreItem}&alias=${datosSesion.alias}`;

    fetch(urlSkin, body)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            rellenarSkinEquipada(respuesta.skinEquipada);
    }).catch(error => {
        console.error(error);
    });
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


/* GESTIONAR EN PROPIEDAD */
const buttonCheck = document.querySelector("#imagenCheck");

let elemComprados=null;

const imagenCheck = document.createElement("img");
imagenCheck.src = "../resources/backgrounds/Checks/Check.png";
imagenCheck.alt = "Check verde";
imagenCheck.classList.add("w-100");
imagenCheck.classList.add("h-100");
imagenCheck.draggable = false;

function initCompradas() {
    const datosSesion = JSON.parse(sessionStorage.getItem("usuario")).usuario;
    const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/UserSkinBougths?correo=${datosSesion.correo}`;

    fetch(urlSkin)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        rellenarItems(respuesta.skinsEquipada);
    }).catch(error => {
        console.error(error);
    });
}

function reiniciarLayoutComprados() {
    const parentGrid = document.querySelector(".parent-grid");
    parentGrid.classList.remove("parent-grid");
    parentGrid.classList.add("parent-grid-equipados");

    const divs = document.querySelectorAll(".elem-layout");

    for (let i = 0; i < divs.length; i++) {
        if(i == 0){
            divs[i].innerHTML = "";
            divs[i].classList.remove("div"+[i+1]);
            divs[i].classList.add("div"+[i+1]+"-equipados");
            divs[i].classList.add("item-shop-rellenar");
            divs[i].classList.add("item-shop-animation-bougths");
        }else if(i == 5 || i == 6){

        }else{
            divs[i].innerHTML = "";
            divs[i].classList.remove("div"+[i+1]);
            divs[i].classList.add("div"+[i+1]+"-equipados");
            divs[i].classList.add("item-shop-animation-bougths");
        }
        
    }
}
function reiniciarLayoutTienda() {
    const parentGrid = document.querySelector(".parent-grid-equipados");
    parentGrid.classList.remove("parent-grid-equipados");
    parentGrid.classList.add("parent-grid");

    elemComprados.forEach(elem => elem.removeEventListener("click", equiparSkin));

    const divs = document.querySelectorAll(".elem-layout");

    for (let i = 0; i < divs.length; i++) {
        if(i == 0){
            divs[i].classList.remove("div"+[i+1]+"-equipados");
            divs[i].classList.remove("item-shop-rellenar");
            divs[i].classList.remove("item-shop-animation-bougths");
            divs[i].innerHTML = `<div class="w-75 h-30 d-flex flex-row align-items-center justify-content-center">
                                    <img src="../resources/backgrounds/Chests/Cofre.png" alt="LootBox" class="h-20" draggable="false">
                                </div>
                                <div class="w-100 h-3 d-flex flex-row align-items-center justify-content-center">
                                    <p class="fs-2 no-margin me-3"> Cofre </p>
                                    <p class="fs-2 no-margin ms-3"> 1025 SP </p>
                                </div> `;
            divs[i].classList.add("div"+[i+1]);
        }else if(i == 5 || i == 6){

        }else{
            divs[i].innerHTML = "";
            divs[i].classList.remove("div"+[i+1]+"-equipados");
            divs[i].classList.remove("item-shop-animation-bougths");
            divs[i].classList.add("div"+[i+1]);
        }
        
    }
}

function gestionarEnPropiedad() {

    pagActual = 1;
    if(!noChecked){
        noChecked = true;
        initFlechas();
        buttonCheck.appendChild(imagenCheck);
        mostrarItems(0);
        reiniciarLayoutComprados();
        initItemsTienda();
        initCompradas();
    }else{
        noChecked = false;
        initFlechas();
        reiniciarLayoutTienda();
        initItemsTienda();
        buttonCheck.removeChild(imagenCheck);
        botonIzquierdo.removeEventListener("click", saltoPagina);
        botonDerecho.addEventListener("click", saltoPagina);
        botonDerecho.style.visibility = "visible";
        botonIzquierdo.style.visibility = "hidden";
    }

}

buttonCheck.addEventListener("click", gestionarEnPropiedad);