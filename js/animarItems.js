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
            boton.addEventListener("click", () => popUp.style.visibility = "hidden");
        })
    }

}

function gestionarCompra(e) {

    const item = {
        nombre : e.currentTarget.parentElement.parentElement.children[1].children[0].textContent,
        precio : e.currentTarget.parentElement.parentElement.children[1].children[1].textContent.split(" ")[1]
    }

    item.nombre = item.nombre.trimStart(item.nombre);
    item.nombre = item.nombre.trimEnd(item.nombre);
    const body = { 
        method: 'POST',
        body: JSON.stringify(item)
    };

    console.log(body);

    if(item.nombre == "Cofre"){
        const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/ChestBougth`;
    
        fetch(urlSkin, body)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
                
        }).catch(error => {
            console.error(error);
        });
        return;
    }
    const urlSkin = `http://localhost/proyectoFinal/api/v1/superSpikes/Shop/SkinBougth`;
    
    fetch(urlSkin, body)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            
    }).catch(error => {
        console.error(error);
    });

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