const iconoSonido = document.querySelector("#altavoz");
const iconoSilencio = document.querySelector("#silencio");
const musica = document.querySelector("#musica");

musica.pause();
iconoSilencio.style.display = "block";

function controlarSonido() {
    if(iconoSilencio.style.display == "block"){

        musica.play();
        iconoSilencio.style.display = "none";
        iconoSonido.style.display = "block";

    }else{
        musica.pause();
        iconoSilencio.style.display = "block";
        iconoSonido.style.display = "none";
    }
}



iconoSonido.addEventListener("click", controlarSonido);
iconoSilencio.addEventListener("click", controlarSonido);