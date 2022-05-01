<?php
    class Formulario
    {
        private $id;
        private $nombre;
        private $descripcion;
        private $fechaInicio;
        private $fechaFinal;
        private $estadoFormulario;
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
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        /**
         * @param mixed $descripcion
         */
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        /**
         * @return mixed
         */
        public function getFechaInicio()
        {
            return $this->fechaInicio;
        }

        /**
         * @param mixed $fechaInicio
         */
        public function setFechaInicio($fechaInicio)
        {
            $this->fechaInicio = $fechaInicio;
        }

        /**
         * @return mixed
         */
        public function getFechaFinal()
        {
            return $this->fechaFinal;
        }

        /**
         * @param mixed $fechaFinal
         */
        public function setFechaFinal($fechaFinal)
        {
            $this->fechaFinal = $fechaFinal;
        }

        /**
         * @return mixed
         */
        public function getEstadoFormulario()
        {
            return $this->estadoFormulario;
        }

        /**
         * @param mixed $estadoFormulario
         */
        public function setEstadoFormulario($estadoFormulario)
        {
            $this->estadoFormulario = $estadoFormulario;
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
