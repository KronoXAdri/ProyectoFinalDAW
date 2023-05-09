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
    
        const cerrar = document.querySelectorAll(".cerrar");
    
        cerrar.forEach(boton =>{
            boton.addEventListener("click", () => popUp.style.visibility = "hidden");
        })
    
        const imagenItem = document.querySelector("#imagenItem");
        imagenItem.innerHTML = "";
        const imagenInsertar = document.createElement("img");
        imagenInsertar.src = e.currentTarget.children[0].children[0].src;
        imagenInsertar.alt = "LootBox";
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
    }

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