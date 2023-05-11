<?php

   class Item{

        private static function getSkinsCharacter($pagina,$numItems){
            try {
                $sql = "SELECT * FROM skin where nombre like 'Character%' AND nombre != 'Character2'
                        LIMIT :numStart , :numItems";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":numStart", $pagina, PDO::PARAM_INT);
                $consulta->bindParam(":numItems", $numItems,  PDO::PARAM_INT);
                $consulta->execute();
            
                while ($filas = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $filas;
                }
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        private static function getTotalSkinsCharacter(){
            try {
                $sql = "SELECT COUNT(*) as 'numTotal' FROM skin where nombre like 'Character%'";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        private static function getTotalItemsBougth($idUsuario){
            try {
                $sql = "SELECT COUNT(*) as 'numTotal' FROM usuarioskin where usuarioskin.id_usuario = :idUsuario";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        private static function hasSkinUser($idUsuario, $idSkin){
            try {
                $sql = "SELECT * FROM usuarioskin where usuarioskin.id_usuario = :idUsuario and usuarioskin.id_skin = :idSkin";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->bindParam(":idSkin", $idSkin);
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? true : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        private static function getSkinsUser($idUsuario){
            try {
                $sql = "SELECT * FROM usuarioskin where usuarioskin.id_usuario = :idUsuario";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->execute();
            
                while ($filas = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $filas;
                }
                
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        public static function getSkins($datos){
            $datosRecibidos = mb_split(";", $datos);
            $pagina = $datosRecibidos[0];
            $numItems = $datosRecibidos[1];

            if(!self::getSkinsCharacter($pagina,$numItems)){
                return header(ERROR["No Content"]);
            }

            $listaSkins = self::getSkinsCharacter($pagina,$numItems);
            $listaDevolver = array();

            foreach ($listaSkins as $elemList) {
                
                $item = new ItemDTO($elemList["NOMBRE"],$elemList["TIPO"],$elemList["PRECIO"]);

                array_push($listaDevolver, $item);
            }

            echo json_encode(array("skins" => $listaDevolver));
            return header(ERROR["OK"]);
        }

        public static function getSkinData($idSkin){
            try {
                $sql = "SELECT * FROM skin where id_skin = :idSkin;";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":idSkin", $idSkin) ;
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        public static function getSkinDataByName($nombreSkin){
            try {
                $sql = "SELECT * FROM skin where nombre = :nombreSkin;";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":nombreSkin", $nombreSkin) ;
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? $datos : false;
                
            } catch (Throwable $e) {
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        public static function comprarItem($idUsuario, $idSkin, $nuevosPuntosUser, $fecha){
            try {
                $sql = "INSERT INTO `usuarioskin` VALUES (:idUsuario, :idSkin)";

                $conexion = Conectar::conexion();
                $conexion->beginTransaction();
                $consulta = $conexion->prepare($sql);

                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->bindParam(":idSkin", $idSkin);

                $idCompra = Compra::realizarCompra($fecha, $conexion);
                Compra::insertarSkinCompra($idSkin, $idUsuario, $idCompra, $conexion);
                User::actualizarPuntos($nuevosPuntosUser, $idUsuario, $conexion);
                $conexion->commit();
                $consulta->closeCursor();
                $consulta->execute();
                
            } catch (Throwable $e) {
                $conexion->rollBack();
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        public static function getCountItems(){

            if(!self::getTotalSkinsCharacter()){
                return header(ERROR["No Content"]);
            }

            $totalItems = self::getTotalSkinsCharacter();

            echo json_encode(array("total" => $totalItems));
            return header(ERROR["OK"]);
        }

        public static function getItemsBougths($datos){

            $datosRecibidos = mb_split(";", $datos);
            $correo = $datosRecibidos[0];
            $datosUser = User::existsUser($correo);

            if(empty($datosUser)){
                return header(ERROR["No Content"]);
            }

            $totalItems = self::getTotalItemsBougth($datosUser[0]["ID_USUARIO"]);

            if(!$totalItems){
                return header(ERROR["No Content"]);
            }

            echo json_encode(array("total" => $totalItems));
            return header(ERROR["OK"]);
        }

        public static function getSkinEquiped($datos){
            $datosRecibidos = mb_split(";", $datos);

            $correo = $datosRecibidos[0];

            $datosUser = User::existsUser($correo);

            if(empty($datosUser)){
                return header(ERROR["No Content"]);
            }

            if(!self::hasSkinUser($datosUser[0]["ID_USUARIO"], $datosUser[0]["SKIN_EQUIPADA"])){
                return header(ERROR["No Content"]);
            }
        
            $skinDatos = self::getSkinData($datosUser[0]["SKIN_EQUIPADA"]);
                
            if(empty($skinDatos)){
                return header(ERROR["No Content"]);
            }

            $skin = new ItemDTO($skinDatos["NOMBRE"], $skinDatos["TIPO"], $skinDatos["PRECIO"]);

            echo json_encode(array("skinEquipada" => $skin));
            return header(ERROR["OK"]);
        }

        public static function getSkinBougths($datos){
            $datosRecibidos = mb_split(";", $datos);

            $correo = $datosRecibidos[0];

            $datosUser = User::existsUser($correo);

            if(empty($datosUser)){
                return header(ERROR["No Content"]);
            }

            $skinsUser = self::getSkinsUser($datosUser[0]["ID_USUARIO"]);

            if(!$skinsUser){
                return header(ERROR["No Content"]);
            }

            $listaSkins = [];
                
            foreach ($skinsUser as $dataCompra) {
                $datosSkin = self::getSkinData($dataCompra["ID_SKIN"]);
                $skin = new ItemDTO($datosSkin["NOMBRE"], $datosSkin["TIPO"], "");
                array_push($listaSkins, $skin);
            }

            echo json_encode(array("skinsEquipada" => $listaSkins));
            return header(ERROR["OK"]);
        }

        public static function putSkins($datos){
            $datosRecibidos = mb_split(";", $datos);

            $nombreSkin = $datosRecibidos[0];
            $aliasUser = $datosRecibidos[1];

            if(!User::existsUserByAlias($aliasUser)){
                return header(ERROR["No Content"]);
            }

            $userData = User::existsUserByAlias($aliasUser);
            $skinData = self::getSkinDataByName($nombreSkin);           

            User::updateSkinEquiped($skinData["ID_SKIN"], $userData[0]["ID_USUARIO"]);

            $skin = new ItemDTO($skinData["NOMBRE"], $skinData["TIPO"], 0);
            echo json_encode(array("skinEquipada" => $skin));
            return header(ERROR["OK"]);
        }

        public static function bougthSkin($datos, $valoresQuery){
            $nombreSkin = $datos["nombre"];
            $precio = $datos["precio"];
            $aliasUser = $valoresQuery;

            if(!User::existsUserByAlias($aliasUser)){
                return header(ERROR["No Content"]);
            }

            $userData = User::existsUserByAlias($aliasUser);
            $skinData = self::getSkinDataByName($nombreSkin);

            
            if(!$skinData || $skinData["PRECIO"] != $precio || $userData[0]["PUNTOS_COMPRA"] < $skinData["PRECIO"]){
                return header(ERROR["Bad Request"]);
            }
            
            $hasSkinUser = self::hasSkinUser($userData[0]["ID_USUARIO"],$skinData["ID_SKIN"]);

            if($hasSkinUser){
                return header(ERROR["Bad Request"]);
            }

            $puntosNuevosUser = (int) $userData[0]["PUNTOS_COMPRA"] - (int) $skinData["PRECIO"];

            $fecha = date("Y-m-d H:i:s");

            self::comprarItem($userData[0]["ID_USUARIO"],$skinData["ID_SKIN"],$puntosNuevosUser, $fecha);

            $skin = new CompraDTO($userData[0]["ALIAS"], $skinData["NOMBRE"], $fecha);
            echo json_encode(array("compra" => $skin));
            return header(ERROR["OK"]);
        }
   }

?>