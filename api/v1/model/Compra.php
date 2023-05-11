<?php

   class Compra{

        public static function realizarCompra($fecha, &$conexion){
            try {
                $sql = "INSERT INTO compra (`fecha`) VALUES (:fecha)";
         
                $consulta = $conexion->prepare($sql);
                $consulta->bindParam(":fecha", $fecha);
                $consulta->execute();

                return $conexion->lastInsertId();
                
            } catch (Throwable $e) {
                $conexion->rollBack();
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

        public static function insertarSkinCompra($idSkin, $idUsuario, $idCompra, &$conexion){
            try {
                $sql = "INSERT INTO skincompra VALUES (:idSkin, :idUsuario, :idCompra)";
         
                $consulta = $conexion->prepare($sql);
                $consulta->bindParam(":idSkin", $idSkin);
                $consulta->bindParam(":idUsuario", $idUsuario);
                $consulta->bindParam(":idCompra", $idCompra);
                $consulta->execute();
                
            } catch (Throwable $e) {
                $conexion->rollBack();
                echo "En la línea "  . $e->getLine() . ' en el archivo ' . $e->getFile() . ': <br>';
                echo "<br>Mensaje de error:" . $e->getMessage();
            }
        }

   }

?>