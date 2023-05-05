const listaItems = document.querySelectorAll(".tag-shop");
const listaBotonesSup = document.querySelectorAll(".tag-shop");

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