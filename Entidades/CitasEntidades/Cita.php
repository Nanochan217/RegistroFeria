<?php
    class Cita
    {
        private $id;        
        private $confirmado;
        private $cantidadAsistentes;
        private $idHorario;
        private $idAsistente;
        private $idEstadoCita;
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
        public function getConfirmado()
        {
            return $this->confirmado;
        }

        /**
         * @param mixed $confirmado
         */
        public function setConfirmado($confirmado)
        {
            $this->confirmado = $confirmado;
        }

        /**
         * @return mixed
         */
        public function getCantidadAsistentes()
        {
            return $this->cantidadAsistentes;
        }

        /**
        * @param mixed $cantidadAsistentes
        */
        public function setCantidadAsistentes($cantidadAsistentes)
        {
           $this->cantidadAsistentes = $cantidadAsistentes;
        }        

        /**
         * @return mixed
         */
        public function getIdHorario()
        {
            return $this->idHorario;
        }

        /**
        * @param mixed $idHorario
        */
        public function setIdHorario($idHorario)
        {
           $this->idHorario = $idHorario;
        }        

        /**
         * @return mixed
         */
        public function getIdAsistente()
        {
            return $this->idAsistente;
        }

        /**
         * @param mixed $idAsistente
         */
        public function setIdAsistente($idAsistente)
        {
            $this->idAsistente = $idAsistente;
        }                

        /**
         * @param mixed $idEstadoCita
         */
        public function setIdEstadoCita($idEstadoCita)
        {
            $this->idEstadoCita = $idEstadoCita;
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
