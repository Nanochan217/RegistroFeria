<?php
    class Cita
    {
        private $id;
        private $dia;
        private $hora;
        private $confirmado;
        private $idAsistente;
        private $idAcompanante;
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
        public function getDia()
        {
            return $this->dia;
        }

        /**
         * @param mixed $dia
         */
        public function setDia($dia)
        {
            $this->dia = $dia;
        }

        /**
         * @return mixed
         */
        public function getHora()
        {
            return $this->hora;
        }

        /**
         * @param mixed $hora
         */
        public function setHora($hora)
        {
            $this->hora = $hora;
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
         * @return mixed
         */
        public function getIdAcompanante()
        {
            return $this->idAcompanante;
        }

        /**
         * @param mixed $idAcompanante
         */
        public function setIdAcompanante($idAcompanante)
        {
            $this->idAcompanante = $idAcompanante;
        }

        /**
         * @return mixed
         */
        public function getIdEstadoCita()
        {
            return $this->idEstadoCita;
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
