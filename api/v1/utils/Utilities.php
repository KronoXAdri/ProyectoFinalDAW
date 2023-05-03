<?php
class Utilities{
    public static function cors()
    {
        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }
        header("Access-Control-Allow-Origin: {$origin}");
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST,PUT,DELETE,OPTIONS");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    }

    public static function filtrarCampos(&$campo){
        $campo= trim($campo);
        $campo= strip_tags($campo);
        $campo= htmlspecialchars($campo);
   }
}

?>