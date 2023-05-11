const tabla = document.querySelector(".table");

function rellenarTabla() {

    const url = "http://localhost/proyectoFinal/api/v1/superSpikes/Ranking";

    fetch(url)
    .then(respuesta => respuesta.json())
    .then(respuesta => {
            dibujarTabla(respuesta.puestos);
    }).catch(error => {
        console.error(error);
    });
}

function dibujarTabla(listaUsuarios) {
    let posicion = 1;

    const userLogged  = JSON.parse(sessionStorage.getItem("usuario"));

    console.log(userLogged);

    listaUsuarios.forEach(puesto => {
        const myUser = (puesto.alias == userLogged.alias)? "miUsuario" : "";
        const tr = document.createElement("tr");
        tr.classList.add("tr-bordered");

        if(myUser != ""){
            tr.classList.add(myUser);
        }

        tr.innerHTML =  `<td>${posicion}</td> 
                        <td>${puesto.alias}</td>
                        <td>${puesto.nivel}</td>
                        <td>${puesto.puntuacion}</td>`;
        
        tabla.appendChild(tr);
        posicion += 1;
    });
}




document.addEventListener("DOMContentLoaded", rellenarTabla);