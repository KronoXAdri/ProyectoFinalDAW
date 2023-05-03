<?php

   class PUT{

    public static function gestionarPut(){
        if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
            $data = json_decode(file_get_contents("php://input"));
            self::putConPath($data);
        }elseif(empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
            // $data = json_decode(file_get_contents("php://input"));
            // self::postConQuery($data);
        }else{
            return header(ERROR["No Content"]);
        }
    }

    private static function putConPath($datos){
        $ruta = mb_split("/", $_SERVER["PATH_INFO"]);

        switch($ruta){
            case (!empty($ruta[1]) && $ruta[1] == "cliente") && (!empty($ruta[3]) && $ruta[3] == "animal"):
                self::putAniadeFotoAni($datos, $ruta);
                break;
            // case (!empty($ruta[1] && $ruta[1] == "cliente")):
            //     self::postAniCliente($datos, $ruta);
            //     break;
            default;
        }
    }

    private static function putAniadeFotoAni($datos, $ruta){
        Funcionalidades::devolverToken($token);

        if($ruta[2] != $token["id"]){
            return header(ERROR["Bad Request"]);
        }
        if(time() > $token["exp"]){
            return header(ERROR["Bad Request"]);
        }
        $comprobar = Usuario::comprobarUsuarioAniObj($ruta[2], $ruta[4]);
        if(empty($comprobar)){
            return header(ERROR["Bad Request"]);
        }

        $datos->imagenAnimal = Funcionalidades::base64_datos($datos->imagenAnimal,"../../resources/img/animales/",$comprobar["NomAnimal"]);

        $datos->idAnimal = $ruta[4];

        Registro::aniadirFoto($datos->idAnimal, $datos->imagenAnimal);

        $datosConsutaMascota = Mascotas::extraerMascotaNumHistorial($datos->idAnimal);
        $path = mb_split("/",dirname($_SERVER['SCRIPT_NAME']));
        $ruta = 'http://'.$_SERVER['SERVER_NAME']."/".$path[1]."/".$path[2]."/resources/img/animales/";
        $datosFotografias = [];
        $datosConsultaFotos = Mascotas::extraerTodasFotoObject($datosConsutaMascota->NumHistorial); 
        foreach ($datosConsultaFotos as $foto) {
            $nombreFotoAni = $ruta.$foto->nombreFoto;
            $datosFotografias[] = $nombreFotoAni;
        }
        $animal = new AnimalStatic($datos->idAnimal,$datosConsutaMascota->NomAnimal,$datosConsutaMascota->idTipo,$datosConsutaMascota->NombreTipo, $datosFotografias);
        

        echo json_encode(array("animal" => $animal));
    }

   }

?>