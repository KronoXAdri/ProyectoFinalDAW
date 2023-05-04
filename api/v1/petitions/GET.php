<?php

    class GET{

        public static function gestionarGet(){
            
            if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
                $data = $_SERVER["PATH_INFO"];
                self::gestionarPath($data);
            }elseif(!empty($_SERVER["QUERY_STRING"]) && empty($_SERVER["PATH_INFO"])){
                $data = $_SERVER["QUERY_STRING"];
                self::gestionarQuery($data);
            }elseif(empty($_SERVER["QUERY_STRING"]) && empty($_SERVER["PATH_INFO"])){
            }else{
                return header(ERROR["No Content"]);
            }
        }
        
        private static function gestionarPath($data){
            $campos = mb_split("/", $data);

            switch ($campos) {
                case (!empty($campos[1]) && $campos[1] == "Ranking"):
                    Ranking::getRanking();
                    break;
                default:
                    return header(ERROR["Bad Request"]);
                    break;
            }
            
        }       
        
        private static function gestionarQuery($datos){
            $query = mb_split("&", $datos);
            $nombresVarQuery = "";
            $valoresQuery = "";

            foreach ($query as $campoQuery) {
                $valoresQuery = $valoresQuery . mb_split("=", $campoQuery)[1] . ";";
                $nombresVarQuery = $nombresVarQuery . mb_split("=", $campoQuery)[0] . ";";
            }
            
            $nombresVarQuery = substr($nombresVarQuery, 0, -1);
            $valoresQuery = substr($valoresQuery, 0, -1);

            switch ($nombresVarQuery) {
                case 'correo;password':
                    User::login($valoresQuery);
                    break;
                default:
                    return header(ERROR["Ok"]);
            }
        }

    }

?>