<?php

    class POST{
        public static function gestionarPost(){

            if(empty($_SERVER["QUERY_STRING"]) && (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"]))){
                $data = json_decode(file_get_contents("php://input"));
                self::postConPath($data);
            }elseif(empty($_SERVER["QUERY_STRING"]) && !empty($_SERVER["PATH_INFO"])){
                $data = json_decode(file_get_contents("php://input"));
                self::postConQuery($data);
            }else{
                return header(ERROR["No Content"]);
            }

        }


        private static function postConPath($datos){            
            $ruta = mb_split("/", $_SERVER["PATH_INFO"]);

            switch($ruta){
                case (!empty($ruta[1] && $ruta[1] == "login")):
                    self::postLogin($datos);
                    break;
                case (!empty($ruta[1] && $ruta[1] == "cliente")):
                    self::postAniCliente($datos, $ruta);
                    break;
                default;
                    
            }
        }

        private static function postConQuery($datos){
        }

        private static function postAniCliente($datos, $ruta){
            Funcionalidades::devolverToken($token);

            if($ruta[2] != $token["id"]){
                return header(ERROR["Bad Request"]);
            }
            if(time() > $token["exp"]){
                return header(ERROR["Bad Request"]);
            }
            if(empty($datos->imagenAnimal)){
                $datos->imagenAnimal = "default.jpg";
            }else{
                $datos->imagenAnimal = Funcionalidades::base64_datos($datos->imagenAnimal,"../../resources/img/animales/",$datos->nomAnimal);
            }
            $datos->idCliente = $token["id"];

            $idUltimoAni = Registro::insertarMascotaPOST($datos);

            $datosConsutaMascota = Mascotas::extraerMascotaNumHistorial($idUltimoAni);
            $path = mb_split("/",dirname($_SERVER['SCRIPT_NAME']));
            $ruta = 'http://'.$_SERVER['SERVER_NAME']."/".$path[1]."/".$path[2]."/resources/img/animales/";
            $datosFotografias = [];
            $datosConsultaFotos = Mascotas::extraerTodasFotoObject($datosConsutaMascota->NumHistorial); 
            foreach ($datosConsultaFotos as $foto) {
                $nombreFotoAni = $ruta.$foto->nombreFoto;
                $datosFotografias[] = $nombreFotoAni;
            }
            $animal = new AnimalStatic($idUltimoAni,$datosConsutaMascota->NomAnimal,$datosConsutaMascota->idTipo,$datosConsutaMascota->NombreTipo, $datosFotografias);
            

            echo json_encode(array("animal" => $animal));
        }

        private static function postLogin($datos){
            $alias = $datos->alias;
            $password = $datos->contraseña;

            if(is_numeric($alias) || $password < 0){
                return header(ERROR["Bad Request"]);
            }

            $consulta = Usuario::existsUser($alias);

            if(!$consulta){
                return header(ERROR["Not Found"]);
            }
            if(!password_verify($password, $consulta[0]["clave"])){
                return header(ERROR["Not Found"]);
            }

            Funcionalidades::crearTokenJWT($consulta[0]["idcliente"],$alias, "usuario");
        }

    }

?> 