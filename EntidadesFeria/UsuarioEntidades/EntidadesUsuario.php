<?php
    class Usuario
    {
        private $id;
        private $cedula;
        private $nombre;
        private $apellido1;
        private $apellido2;
        private $idCredenciales;
        private $idPerfil;
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
        public function getCedula()
        {
            return $this->cedula;
        }

        /**
         * @param mixed $cedula
         */
        public function setCedula($cedula)
        {
            $this->cedula = $cedula;
        }

        /**
         * @return mixed
         */
        public function getNombre()
        {
            return $this->nombre;
        }

        /**
         * @param mixed $nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        /**
         * @return mixed
         */
        public function getApellido1()
        {
            return $this->apellido1;
        }

        /**
         * @param mixed $apellido1
         */
        public function setApellido1($apellido1)
        {
            $this->apellido1 = $apellido1;
        }

        /**
         * @return mixed
         */
        public function getApellido2()
        {
            return $this->apellido2;
        }

        /**
         * @param mixed $apellido2
         */
        public function setApellido2($apellido2)
        {
            $this->apellido2 = $apellido2;
        }

        /**
         * @return mixed
         */
        public function getIdCredenciales()
        {
            return $this->idCredenciales;
        }

        /**
         * @param mixed $idCredenciales
         */
        public function setIdCredenciales($idCredenciales)
        {
            $this->idCredenciales = $idCredenciales;
        }

        /**
         * @return mixed
         */
        public function getIdPerfil()
        {
            return $this->idPerfil;
        }

        /**
         * @param mixed $idPerfil
         */
        public function setIdPerfil($idPerfil)
        {
            $this->idPerfil = $idPerfil;
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




