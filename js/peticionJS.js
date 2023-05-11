const correo = document.querySelector("#correo");
const password = document.querySelector("#inputPassword");
const boton = document.querySelector("#boton")

let url;

function gestionarPeticion(e) {
    
    e.preventDefault();
    url = "http://localhost/proyectoFinal/api/v1/superSpikes?correo=" + correo.value + "&password=" + password.value;

    fetch(url)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            sessionStorage.setItem("usuario", JSON.stringify(respuesta.usuario));
            window.location="src/main.html";
    }).catch(error => {
        correo.style.color = "red";
        correo.value = "Error, Email o Contraseña no válidos."
        password.value = "";
    });
}

boton.addEventListener("click", gestionarPeticion);
correo.addEventListener("click", () => {
                                        if(correo.value == "Error, Email o Contraseña no válidos."){
                                            correo.value = ""
                                            correo.style.color = "black";
                                        }
                                    }
                        )