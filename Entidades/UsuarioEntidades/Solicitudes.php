<?php

    class Solicitudes
    {
        private $id;
        private $correoUsuario;
        private $fechaSolicitud;
        private $fechaExpiracion;
        private $codigoSolicitud;
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
        public function getCorreoUsuario()
        {
            return $this->correoUsuario;
        }

        /**
         * @param mixed $correoUsuario
         */
        public function setCorreoUsuario($correoUsuario)
        {
            $this->correoUsuario = $correoUsuario;
        }

        /**
         * @return mixed
         */
        public function getFechaSolicitud()
        {
            return $this->fechaSolicitud;
        }

        /**
         * @param mixed $fechaSolicitud
         */
        public function setFechaSolicitud($fechaSolicitud)
        {
            $this->fechaSolicitud = $fechaSolicitud;
        }

        /**
         * @return mixed
         */
        public function getFechaExpiracion()
        {
            return $this->fechaExpiracion;
        }

        /**
         * @param mixed $fechaExpiracion
         */
        public function setFechaExpiracion($fechaExpiracion)
        {
            $this->fechaExpiracion = $fechaExpiracion;
        }

        /**
         * @return mixed
         */
        public function getCodigoSolicitud()
        {
            return $this->codigoSolicitud;
        }

        /**
         * @param mixed $codigoSolicitud
         */
        public function setCodigoSolicitud($codigoSolicitud)
        {
            $this->codigoSolicitud = $codigoSolicitud;
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