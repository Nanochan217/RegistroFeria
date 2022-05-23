<?php

class Comprobante 
{
    private $id;
    private $nombreComprobante;
    private $descripcion;
    private $fechaComprobante;
    private $idCita;
    private $documento;
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
    public function getNombreComprobante()
    {
        return $this->nombreComprobante;
    }

    /**
     * @param mixed $nombreComprobante
     */
    public function setNombreComprobante($nombreComprobante)
    {
        $this->nombreComprobante = $nombreComprobante;
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
    public function getFechaComprobante()
    {
        return $this->fechaComprobante;
    }

    /**
     * @param mixed $fechaComprobante
     */
    public function setFechaComprobante($fechaComprobante)
    {
        $this->fechaComprobante = $fechaComprobante;
    }
    
    /**
    * @return mixed
    */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * @param mixed $idCita
     */
    public function setIdCita($idCita)
    {
        $this->idCita = $idCita;
    }
    
    /**
    * @return mixed
    */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param mixed $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
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
