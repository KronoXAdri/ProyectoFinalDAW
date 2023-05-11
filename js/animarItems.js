const listaItems = document.querySelectorAll(".tag-shop");
let listaItemsShop = document.querySelectorAll(".item-shop");

const popUp = document.querySelector("#popup")

let isAnimated = false;

function animarItems(e) {

    if (!isAnimated) {
        e.currentTarget.classList.add("animacion-rebote");
        desactivarEventos();
        isAnimated = true;
    }
    
    setTimeout((e) => {
        if (isAnimated) {
            limpiarItems();
        }
    },600);
}


function limpiarItems(){
    listaItems.forEach(item => {
        if(item.classList.contains("animacion-rebote")){
            item.classList.remove("animacion-rebote");
            isAnimated = false;
            activarEventos();
            return;
        }

    })
}

function gestionarPopUpYCompra(e) {
    if(!e.currentTarget.classList.contains("item-shop-animation-bougths")){
        const pregunta = document.querySelector("#preguntaCompra");
        const opcionesComra = document.querySelector("#opcionesCompra");

        pregunta.style.visibility = "visible";
        opcionesComra.style.visibility = "visible";

        popUp.style.visibility = "visible";
        listaItemsShop = document.querySelectorAll(".item-shop");
    
        const imagenItem = document.querySelector("#imagenItem");
        imagenItem.innerHTML = "";
        const imagenInsertar = document.createElement("img");
        imagenInsertar.src = e.currentTarget.children[0].children[0].src;
        imagenInsertar.alt = e.currentTarget.children[1].children[0].textContent;
        imagenInsertar.classList.add("h-20");
        imagenInsertar.draggable = false;
        imagenItem.appendChild(imagenInsertar);
        
        const descripcionItem = document.querySelector("#descripcionItem");
        descripcionItem.innerHTML = "";
        const nombreItem = document.createElement("p");
        nombreItem.classList.add("fs-2");
        nombreItem.classList.add("no-margin");
        nombreItem.classList.add("me-3");
        nombreItem.textContent = e.currentTarget.children[1].children[0].textContent;
        descripcionItem.appendChild(nombreItem);
        
        const precioItem = document.createElement("p");
        precioItem.classList.add("fs-2");
        precioItem.classList.add("no-margin");
        precioItem.classList.add("me-3");
        precioItem.textContent = e.currentTarget.children[1].children[1].textContent;
        descripcionItem.appendChild(precioItem);

        const cerrar = document.querySelectorAll(".cerrar");
        const comprar = document.querySelector(".si-compra");

        comprar.addEventListener("click", gestionarCompra);
    
        cerrar.forEach(boton =>{
            boton.addEventListener("click", () => {
                popUp.style.visibility = "hidden"
                pregunta.style.visibility = "hidden";
                opcionesComra.style.visibility = "hidden";
            });
        })
    }

}

function gestionarCompra(e) {
    let datosSesion = JSON.parse(sessionStorage.getItem("usuario"));
    datosSesion.alias = datosSesion.alias.trimStart();
    datosSesion.alias = datosSesion.alias.trimEnd();

    const item = {
        nombre : e.currentTarget.parentElement.parentElement.children[1].children[0].textContent,
        precio : e.currentTarget.parentElement.parentElement.children[1].children[1].textContent.split(" ")[1]
    }

    item.nombre = item.nombre.trimStart(item.nombre);
    item.nombre = item.nombre.trimEnd(item.nombre);
    item.precio = item.precio.trimStart(item.precio);
    item.precio = item.precio.trimEnd(item.precio);

    const body = { 
        method: 'POST',
        body: JSON.stringify(item)
    };

    console.log(item);

    if(item.nombre == "Cofre"){
        const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/ChestBougth?alias=${datosSesion.alias}`;
    
        fetch(urlSkin, body)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            const spikePoints = document.querySelector("#spikePoints");
            spikePoints.textContent = respuesta.compra.puntosUsuario;
            pintarComprado(respuesta.compra.nombreSkin);
            datosSesion.puntosCompra = respuesta.compra.puntosUsuario;
            sessionStorage.setItem("usuario", JSON.stringify(datosSesion));
    
            setTimeout(() => {
                popUp.style.visibility = "hidden";
            }, 4000);
        }).catch(error => {
            mostrarError(item.nombre);
        });
        return;
    }
    const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/SkinBougth?alias=${datosSesion.alias}`;
    
    fetch(urlSkin, body)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        const spikePoints = document.querySelector("#spikePoints");
        spikePoints.textContent = respuesta.compra.puntosUsuario;
        pintarComprado(respuesta.compra.nombreSkin);
        datosSesion.puntosCompra = respuesta.compra.puntosUsuario;
        sessionStorage.setItem("usuario", JSON.stringify(datosSesion));

        setTimeout(() => {
            popUp.style.visibility = "hidden";
        }, 4000);
    }).catch(error => {
        mostrarError(item.nombre);
    });

}

function pintarComprado(nombreSkin) {
    const pregunta = document.querySelector("#preguntaCompra");
    const opcionesComra = document.querySelector("#opcionesCompra");

    pregunta.style.visibility = "hidden";
    opcionesComra.style.visibility = "hidden";

    const imagenItem = document.querySelector("#imagenItem");
    imagenItem.innerHTML = "";
    const imagenInsertar = document.createElement("img");
    imagenInsertar.src = "../resources/assets/character/" + nombreSkin + "/Animated/Walk1.png";
    imagenInsertar.alt = nombreSkin;
    imagenInsertar.classList.add("h-20");
    imagenInsertar.draggable = false;
    imagenItem.appendChild(imagenInsertar);
    
    const descripcionItem = document.querySelector("#descripcionItem");
    descripcionItem.innerHTML = "";
    const nombreItem = document.createElement("p");
    nombreItem.classList.add("fs-2");
    nombreItem.classList.add("no-margin");
    nombreItem.classList.add("ms-2");
    nombreItem.textContent = nombreSkin + " Comprado con éxito!";
    descripcionItem.appendChild(nombreItem);
}

function mostrarError(nombreSkin) {
    const pregunta = document.querySelector("#preguntaCompra");
    const opcionesComra = document.querySelector("#opcionesCompra");

    pregunta.style.visibility = "hidden";
    opcionesComra.style.visibility = "hidden";

    const imagenItem = document.querySelector("#imagenItem");
    imagenItem.innerHTML = "";
    const imagenInsertar = document.createElement("img");
    imagenInsertar.src = "../resources/assets/character/" + nombreSkin + "/Animated/Walk1.png";
    imagenInsertar.alt = nombreSkin;
    imagenInsertar.classList.add("h-20");
    imagenInsertar.draggable = false;
    imagenItem.appendChild(imagenInsertar);
    
    const descripcionItem = document.querySelector("#descripcionItem");
    descripcionItem.innerHTML = "";
    const nombreItem = document.createElement("p");
    nombreItem.classList.add("fs-2");
    nombreItem.classList.add("no-margin");
    nombreItem.classList.add("ms-2");
    nombreItem.textContent = "Ya posees esa skin!";
    descripcionItem.appendChild(nombreItem);

    popUp.children[0].classList.add("animacion-error");
    popUp.children[0].classList.add("borde-error");

    setTimeout(() => {
        popUp.children[0].classList.remove("animacion-error");
        popUp.children[0].classList.remove("borde-error");
        popUp.style.visibility = "hidden";
    }, 2000);
}

function desactivarEventos() {
    listaItems.forEach(item => {
        item.removeEventListener("click", animarItems);
    });
}

function activarEventos() {
    listaItems.forEach(item => {
        item.addEventListener("click", animarItems);
    });
}

listaItems.forEach(item => {
    item.addEventListener("click", animarItems);
});

listaItemsShop.forEach(item => {
    item.addEventListener("click", gestionarPopUpYCompra);
});