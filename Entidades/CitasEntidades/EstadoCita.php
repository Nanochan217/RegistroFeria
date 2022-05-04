<?php
    class EstadoCita
    {
        private $id;
        private $estadoCita;
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
        public function getEstadoCita()
        {
            return $this->estadoCita;
        }

        /**
         * @param mixed $estadoCita
         */
        public function setEstadoCita($estadoCita)
        {
            $this->estadoCita = $estadoCita;
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
