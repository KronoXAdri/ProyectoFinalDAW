const frame = document.querySelector("#animated");

const path = "resources/assets/character/2/Animated/";
let numberImage = 1;

function chargeImage() {    
    setInterval(() => {
        charge();
    }, 100);
}


function charge() {

    frame.innerHTML = "";

    if(numberImage > 4){
        numberImage = 1;
    }

    const div = document.createElement("img");
    div.src = path + "Walk" + numberImage + ".png"
    div.width = "105";

    frame.appendChild(div);
    div.draggable = false;
    numberImage++;
}







window.addEventListener("DOMContentLoaded", chargeImage);