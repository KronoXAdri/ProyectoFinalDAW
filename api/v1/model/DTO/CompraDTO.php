<?php

   class CompraDTO{

        public $aliasUsuario;
        public $puntosUsuario;
        public $nombreSkin;    
        public $fechaCompra;

        function __construct($aliasUsuario, $puntosUsuario, $nombreSkin, $fechaCompra){
            
            $this->aliasUsuario = $aliasUsuario;
            $this->puntosUsuario = $puntosUsuario;
            $this->nombreSkin = $nombreSkin;
            $this->fechaCompra = $fechaCompra;
        }


        /**
         * Get the value of fechaCompra
         */ 
        public function getFechaCompra()
        {
                return $this->fechaCompra;
        }

        /**
         * Set the value of fechaCompra
         *
         * @return  self
         */ 
        public function setFechaCompra($fechaCompra)
        {
                $this->fechaCompra = $fechaCompra;

                return $this;
        }

        /**
         * Get the value of nombreSkin
         */ 
        public function getNombreSkin()
        {
                return $this->nombreSkin;
        }

        /**
         * Set the value of nombreSkin
         *
         * @return  self
         */ 
        public function setNombreSkin($nombreSkin)
        {
                $this->nombreSkin = $nombreSkin;

                return $this;
        }

        /**
         * Get the value of aliasUsuario
         */ 
        public function getAliasUsuario()
        {
                return $this->aliasUsuario;
        }

        /**
         * Set the value of aliasUsuario
         *
         * @return  self
         */ 
        public function setAliasUsuario($aliasUsuario)
        {
                $this->aliasUsuario = $aliasUsuario;

                return $this;
        }

        /**
         * Get the value of puntosUsuario
         */ 
        public function getPuntosUsuario()
        {
                return $this->puntosUsuario;
        }

        /**
         * Set the value of puntosUsuario
         *
         * @return  self
         */ 
        public function setPuntosUsuario($puntosUsuario)
        {
                $this->puntosUsuario = $puntosUsuario;

                return $this;
        }
   }

?>