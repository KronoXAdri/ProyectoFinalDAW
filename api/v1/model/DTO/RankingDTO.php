<?php

   class RankingDTO{

        public $alias;    
        public $nivel;
        public $puntuacion;

        function __construct($alias, $nivel, $puntuacion){
            $this->alias = $alias;                    
            $this->nivel = $nivel;                
            $this->puntuacion = $puntuacion;                    
        }

        /**
         * Get the value of puntuacion
         */ 
        public function getPuntuacion()
        {
                return $this->puntuacion;
        }

        /**
         * Set the value of puntuacion
         *
         * @return  self
         */ 
        public function setPuntuacion($puntuacion)
        {
                $this->puntuacion = $puntuacion;

                return $this;
        }

        /**
         * Get the value of nivel
         */ 
        public function getNivel()
        {
                return $this->nivel;
        }

        /**
         * Set the value of nivel
         *
         * @return  self
         */ 
        public function setNivel($nivel)
        {
                $this->nivel = $nivel;

                return $this;
        }

        /**
         * Get the value of alias
         */ 
        public function getAlias()
        {
                return $this->alias;
        }

        /**
         * Set the value of alias
         *
         * @return  self
         */ 
        public function setAlias($alias)
        {
                $this->alias = $alias;

                return $this;
        }
   }

?>