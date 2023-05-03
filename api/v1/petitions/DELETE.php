<?php

    class DELETE{

        public static function gestionarDelete(){
            if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
                $data = $_SERVER["PATH_INFO"];
                self::deleteConPath($data);
            }elseif(empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
                // $data = json_decode(file_get_contents("php://input"));
                // self::postConQuery($data);
            }else{
                return header(ERROR["No Content"]);
            }
        }

        private static function deleteConPath($datos){
            Funcionalidades::devolverToken($token);
            $datos = mb_split("/", $datos);
            // var_dump($datos[4]);
            // exit;
            if($datos[2] != $token["id"]){
                return header(ERROR["Bad Request"]);
            }
            if(time() > $token["exp"]){
                return header(ERROR["Bad Request"]);
            }

            $comprobar = Usuario::comprobarUsuarioAniObj($datos[2], $datos[4]);

            if(empty($comprobar)){
                return header(ERROR["Bad Request"]);
            }

            Mascotas::eliminarMascota($datos[4], $comprobar["nombreFoto"]);
            return header(ERROR["OK"]);
        }
    }
?>