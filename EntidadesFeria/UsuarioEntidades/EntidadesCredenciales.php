<?php
    class Credenciales
    {
        private $id;
        private $correo;
        private $contrasena;
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
        public function getCorreo()
        {
            return $this->correo;
        }

        /**
         * @param mixed $correo
         */
        public function setCorreo($correo)
        {
            $this->correo = $correo;
        }

        /**
         * @return mixed
         */
        public function getContrasena()
        {
            return $this->contrasena;
        }

        /**
         * @param mixed $contrasena
         */
        public function setContrasena($contrasena)
        {
            $this->contrasena = $contrasena;
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
