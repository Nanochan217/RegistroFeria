<?php
    class Horario
    {
        private $id;
        private $horaInicio;
        private $horaFinal;
        private $aforoMaximo;
        private $idDiaHabil;
        private $visible;
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
        public function getHoraInicio()
        {
            return $this->horaInicio;
        }

        /**
         * @param mixed $horaInicio
         */
        public function setHoraInicio($horaInicio)
        {
            $this->horaInicio = $horaInicio;
        }

        /**
         * @return mixed
         */
        public function getHoraFinal()
        {
            return $this->horaFinal;
        }

        /**
         * @param mixed $horaFinal
         */
        public function setHoraFinal($horaFinal)
        {
            $this->horaFinal = $horaFinal;
        }

        /**
         * @return mixed
         */
        public function getAforoMaximo()
        {
            return $this->aforoMaximo;
        }

        /**
         * @param mixed $aforoMaximo
         */
        public function setAforoMaximo($aforoMaximo)
        {
            $this->aforoMaximo = $aforoMaximo;
        }

        /**
         * @return mixed
         */
        public function getIdDiaHabil()
        {
            return $this->idDiaHabil;
        }

        /**
         * @param mixed $idDiaHabil
         */
        public function setIdDiaHabil($idDiaHabil)
        {
            $this->idDiaHabil = $idDiaHabil;
        }

        /**
         * @return mixed
         */
        public function getVisible()
        {
            return $this->visible;
        }

        /**
         * @param mixed $visible
         */
        public function setVisible($visible)
        {
            $this->visible = $visible;
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