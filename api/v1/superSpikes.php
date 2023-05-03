<?php
    header('Content-Type: application/JSON');
    require "utils/Utilities.php";
    
    Utilities::cors();
    const CLAVE = "MiClave";
    const ERROR = [
        "OK" => "HTTP/1.0 200 OK → La solicitud ha tenido éxito",
        "Created" => "HTTP/1.0 201 Created → La solicitud ha tenido éxito y se ha creado un nuevo recurso",
        "No Content" => "HTTP/1.0 204 No Content → La petición se ha completado con éxito, pero su respuesta no tiene ningún contenido",
        "Bad Request" => "HTTP/1.0 400 Bad Request → La solicitud contiene sintaxis errónea y no debería repetirse",
        "Unauthorized" => "HTTP/1.0 401 Unauthorized → La solicitud no se ha procesado, faltan de credenciales de autenticación válidas",
        "Not Found" => "HTTP/1.0 404 Not Found → El servidor no pudo encontrar el contenido solicitado",
        "Unprocessable" => "HTTP/1.0 422 Unprocessable Entity → Entidad no procesable",
        "Internal Server Error" => "HTTP/1.0 500 Internal Server Error → Se ha producido un error interno"
    ];

    const DIR = [0 => "connector/", 1 => "model/", 2 => "controller/", 3 => "utils/", 4 => "petitions/", 5 => "model/DTO/"]; 
    spl_autoload_register(function ($clase){
        foreach (DIR as $value) {
            if(file_exists($value . $clase . ".php")) require $value . $clase . ".php";
        }
    });

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            POST::gestionarPost();
            break;
        case "GET":
            GET::gestionarGet();
            break;
        case "PUT":
            PUT::gestionarPut();
            break;
        case "DELETE":
            DELETE::gestionarDelete();
            break;
        default:
            header(ERROR["Bad Request"]);
    }

?>