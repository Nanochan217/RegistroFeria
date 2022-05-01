<?php
    class DiaHabil
    {
        private $id;
        private $dia;
        private $idFormulario;
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
        public function getIdFormulario()
        {
            return $this->idFormulario;
        }

        /**
         * @param mixed $idFormulario
         */
        public function setIdFormulario($idFormulario)
        {
            $this->idFormulario = $idFormulario;
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
