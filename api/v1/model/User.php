<?php

    class User{

        public static function existsUser($correo){
            try {
                $sql = "SELECT * FROM usuario WHERE correo_electronico=:correo;";
         
                $consulta = Conectar::conexion()->prepare($sql);
                $consulta->bindParam(":correo", $correo);
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

        public static function login($data){
            $data = mb_split(";", $data);

            if(empty($data[0]) || empty($data[1])){
                return false;
            }
    
            $correo = $data[0];
            $password = $data[1];
    
            Utilities::filtrarCampos($correo);
            Utilities::filtrarCampos($password);

            if(!self::existsUser($correo)){
                return header(ERROR["No Content"]);
            }
    
            $datos = self::existsUser($correo);
            
            if(isset($datos[0]["PASSWORD"])){
                if(!password_verify($password, $datos[0]["PASSWORD"])){
                    return header(ERROR["No Content"]);
                }
            }
            $usuarios = new UserDTO($datos[0]["ALIAS"], $datos[0]["PAIS"], $datos[0]["CORREO_ELECTRONICO"], $datos[0]["PUNTOS_COMPRA"], $datos[0]["SKIN_EQUIPADA"], $datos[0]["ADMIN"]);
            
            echo json_encode(array("usuario" => $usuarios));
            return header(ERROR["OK"]);
        }
}

?>