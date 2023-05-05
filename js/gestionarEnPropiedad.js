const buttonCheck = document.querySelector("#imagenCheck")

const imagenCheck = document.createElement("img");
imagenCheck.src = "../resources/backgrounds/Checks/Check.png";
imagenCheck.alt = "Check verde";
imagenCheck.classList.add("w-100");
imagenCheck.classList.add("h-100");
imagenCheck.draggable = false;

let noChecked = false;

function gestionarEnPropiedad() {

    if(!noChecked){
        buttonCheck.appendChild(imagenCheck);
    }else{
        buttonCheck.removeChild(imagenCheck);
    }


    noChecked = !noChecked;
}






buttonCheck.addEventListener("click", gestionarEnPropiedad);
