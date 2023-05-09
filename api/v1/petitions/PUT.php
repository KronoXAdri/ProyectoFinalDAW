<?php

   class PUT{

    public static function gestionarPut(){
        if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
            $data = $_SERVER["PATH_INFO"];
            self::putConPath($data);
        }elseif(!empty($_SERVER["QUERY_STRING"]) && empty($_SERVER["PATH_INFO"])){
            $data = $_SERVER["QUERY_STRING"];
            self::putConQuery($data);
        }elseif(!empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
            $dataQuery = $_SERVER["QUERY_STRING"];
            $dataPath = $_SERVER["PATH_INFO"];
            self::gestionarAmbos($dataQuery, $dataPath);
        }elseif(empty($_SERVER["QUERY_STRING"]) && empty($_SERVER["PATH_INFO"])){
        }else{
            return header(ERROR["No Content"]);
        }
    }

    private static function putConQuery($datos){
        return header(ERROR["No Content"]);
        $ruta = mb_split("/", $_SERVER["PATH_INFO"]);

        switch($ruta){
            default;
        }
    }

    private static function putConPath($datos){
        return header(ERROR["No Content"]);
        $ruta = mb_split("/", $_SERVER["PATH_INFO"]);

        switch($ruta){
            default;
        }
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

        if($nombresVarQuery == "nombreItem;alias" && $camposPath[1] == "Shop" && $camposPath[2] == "UserSkinEquiped"){
                Item::putSkins($valoresQuery);
        }else{
            return header(ERROR["Bad Request"]);
        }
        
    }

   }

?>