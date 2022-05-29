<?php
class Configuracion
{
    private $id;
    private $fechaInicio;
    private $fechaFinal;
    private $acompanateMax;
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
    public function getAcompanantesMax()
    {
        return $this->acompanateMax;
    }

    /**
     * @param mixed $fechaFinal
     */
    public function setAcompanantesMax($acompanateMax)
    {
        $this->acompanateMax = $acompanateMax;
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
