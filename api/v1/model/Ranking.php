<?php

    class Ranking{

        private static function getAllRanking(){
            try {
                $sql = "SELECT usuarionivel.puntuacion, usuario.alias, nivel.mundo, nivel.numero FROM usuarionivel
                        JOIN usuario ON usuario.id_usuario = usuarionivel.id_usuario
                        JOIN nivel ON nivel.id_nivel = usuarionivel.id_nivel
                        order by usuarionivel.puntuacion desc
                        Limit 10;";
         
                $consulta = Conectar::conexion()->prepare($sql);
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

        public static function getRanking(){

            if(!self::getAllRanking()){
                return header(ERROR["No Content"]);
            }

            $listaRanking = self::getAllRanking();
            $listaPuestos = array();

            foreach ($listaRanking as $elemList) {
                $mundo = $elemList["mundo"] . "-" . $elemList["numero"];
                $posicion = new RankingDTO($elemList["alias"], $mundo, $elemList["puntuacion"]);

                array_push($listaPuestos, $posicion);
            }

            echo json_encode(array("puestos" => $listaPuestos));
            return header(ERROR["OK"]);
        }
    }


?>