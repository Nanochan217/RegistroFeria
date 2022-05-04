<?php
    class Perfil
    {
        private $id;
        private $nombrePerfil;
        private $descripcion;
        private $active;

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getNombrePerfil()
        {
            return $this->nombrePerfil;
        }

        /**
         * @param mixed $nombrePerfil
         */
        public function setNombrePerfil($nombrePerfil)
        {
            $this->nombrePerfil = $nombrePerfil;
        }

        /**
         * @return mixed
         */
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        /**
         * @param mixed $descripcion
         */
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        /**
         * @return mixed
         */
        public function getActive()
        {
            return $this->active;
        }

        /**
         * @param mixed $active
         */
        public function setActive($active)
        {
            $this->active = $active;
        }
    }
