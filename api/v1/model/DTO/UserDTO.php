<?php

   class UserDTO{

        public $alias;
        public $pais;
        public $correo;
        public $puntosCompra;
        public $skinEquipada;
        public $admin;

        function __construct($alias, $pais, $correo, $puntosCompra , $skinEquipada, $admin){
            $this->alias = $alias;
            $this->pais = $pais;
            $this->correo = $correo;
            $this->puntosCompra = $puntosCompra;
            $this->skinEquipada = $skinEquipada;
            $this->admin = $admin;
        }

        /**
         * Get the value of name
         */ 
        public function getAlias()
        {
                return $this->alias;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setAlias($alias)
        {
                $this->alias = $alias;

                return $this;
        }

        /**
         * Get the value of pais
         */ 
        public function getPais()
        {
                return $this->pais;
        }

        /**
         * Set the value of pais
         *
         * @return  self
         */ 
        public function setPais($pais)
        {
                $this->pais = $pais;

                return $this;
        }

        /**
         * Get the value of correo
         */ 
        public function getCorreo()
        {
                return $this->correo;
        }

        /**
         * Set the value of correo
         *
         * @return  self
         */ 
        public function setCorreo($correo)
        {
                $this->correo = $correo;

                return $this;
        }

        /**
         * Get the value of skinEquipada
         */ 
        public function getSkinEquipada()
        {
                return $this->skinEquipada;
        }

        /**
         * Set the value of skinEquipada
         *
         * @return  self
         */ 
        public function setSkinEquipada($skinEquipada)
        {
                $this->skinEquipada = $skinEquipada;

                return $this;
        }

        /**
         * Get the value of puntosCompra
         */ 
        public function getPuntosCompra()
        {
                return $this->puntosCompra;
        }

        /**
         * Set the value of puntosCompra
         *
         * @return  self
         */ 
        public function setPuntosCompra($puntosCompra)
        {
                $this->puntosCompra = $puntosCompra;

                return $this;
        }

        /**
         * Get the value of admin
         */ 
        public function getAdmin()
        {
                return $this->admin;
        }

        /**
         * Set the value of admin
         *
         * @return  self
         */ 
        public function setAdmin($admin)
        {
                $this->admin = $admin;

                return $this;
        }
   }

?>