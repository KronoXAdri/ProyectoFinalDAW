<?php

    class POST{
        public static function gestionarPost(){
            
            if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
                $data = json_decode(file_get_contents("php://input"));
                self::postConPath($data);
            }elseif(empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
                $data = json_decode(file_get_contents("php://input"));
                self::postConQuery($data);
            }elseif(!empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
                $dataQuery = $_SERVER["QUERY_STRING"];
                $dataPath = $_SERVER["PATH_INFO"];
                self::gestionarAmbos($dataQuery, $dataPath);
            }else{
                return header(ERROR["No Content"]);
            }

        }


        private static function postConPath($datos){        
            $campos = mb_split("/", $datos);

            switch($campos){
                default:
                    return header(ERROR["Bad Request"]);
                    break;
            }
        }

        private static function postConQuery($datos){
            return header(ERROR["Bad Request"]);
        }

        private static function gestionarAmbos($dataQuery, $dataPath){
            $query = mb_split("&", $dataQuery);
            $nombresVarQuery = "";
            $valoresQuery = "";

            foreach ($query as $campoQuery) {
                $valoresQuery = $valoresQuery . mb_split("=", $campoQuery)[1] . ";";
                $nombresVarQuery = $nombresVarQuery . mb_split("=", $campoQuery)[0] . ";";
            }
            
            $nombresVarQuery = substr($nombresVarQuery, 0, -1);
            $valoresQuery = substr($valoresQuery, 0, -1);
            $camposPath = mb_split("/", $dataPath);

            if($nombresVarQuery == "alias" && $camposPath[1] == "Shop" && $camposPath[2] == "SkinBougth"){
                $data = json_decode(file_get_contents('php://input'), true);
                
                if(empty($data) || (!isset($data["nombre"]) || empty($data["nombre"]) || (!isset($data["nombre"]) || empty($data["precio"])))){
                    return header(ERROR["Bad Request"]);
                }
                    Item::bougthSkin($data,$valoresQuery);
            }else{
            if($nombresVarQuery == "alias" && $camposPath[1] == "Shop" && $camposPath[2] == "ChestBougth"){
                $data = json_decode(file_get_contents('php://input'), true);
                
                if(empty($data) || (!isset($data["nombre"]) || empty($data["nombre"]) || (!isset($data["nombre"]) || empty($data["precio"])))){
                    return header(ERROR["Bad Request"]);
                }
                    Item::bougthChest($data,$valoresQuery);
            }else{
                return header(ERROR["Bad Request"]);
            }

            }
        }
    }

?> 