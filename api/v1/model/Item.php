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

        private static function hasSkinUser($idUsuario, $idSkin){
            try {
                $sql = "SELECT * FROM usuarioskin where usuarioskin.id_usuario = :idUsuario and usuarioskin.id_skin = :idSkin";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->bindParam(":idSkin", $idSkin) ;
                $consulta->execute();
            
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                
                $consulta->closeCursor();
                return (!empty($datos))? true : false;
                
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

        public static function getCountItems(){

            if(!self::getTotalSkinsCharacter()){
                return header(ERROR["No Content"]);
            }

            $totalItems = self::getTotalSkinsCharacter();

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
   }

?>