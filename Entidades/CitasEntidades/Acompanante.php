<?php
    class Acompanante
    {
        private $id;
        private $cedula;
        private $nombre;
        private $idTipoAcompanante;
        private $idCita;
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
        public function getIdTipoAcompanante()
        {
            return $this->idTipoAcompanante;
        }

        /**
         * @param mixed $idTipoAcompanante
         */
        public function setIdTipoAcompanante($idTipoAcompanante)
        {
            $this->idTipoAcompanante = $idTipoAcompanante;
        }

        /**
         * @return mixed
         */
        public function getIdCita()
        {
            return $this->idCita;
        }

        /**
         * @param mixed $idCita
         */
        public function setIdCita($idCita): void
        {
            $this->idCita = $idCita;
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
