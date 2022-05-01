<?php
    class TipoAcompanante
    {
        private $id;
        private $tipoAcompanante;
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
        public function getTipoAcompanante()
        {
            return $this->tipoAcompanante;
        }

        /**
         * @param mixed $tipoAcompanante
         */
        public function setTipoAcompanante($tipoAcompanante)
        {
            $this->tipoAcompanante = $tipoAcompanante;
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
