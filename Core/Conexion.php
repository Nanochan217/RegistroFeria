<?php
class Conexion
{
    private $mysqli;

    //Método para abrir una nueva conexión a la Base de Datos    
    function NuevaConexion()
    {
        $usuario = "root";
        $contrasena = "";
        $db = "feriavocacionalcovao";//Nombre de la Base de Datos

        if (!$this->mysqli = new mysqli('localhost', $usuario, $contrasena, $db)) {
            //Mensaje de error en caso de que no se logre realizar la conexión
            die('Error de conexion (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }  
        $this->mysqli->autocommit(TRUE);      
    }

    //Método para hacer Consultas SQL a la Base de Datos
    function NuevaConsulta($query)
    {
        $respuestaDB = $this->mysqli->query($query);
        return $respuestaDB;
    }
    
    //Funcion para obtener el ultimo id de la ultima inserción en la Base de Datos
    function ObtenerIdUltimoInsert()
    {                        
        $respuestaDB = $this->mysqli->insert_id;        
        return $respuestaDB;
    }

    //Cierra la Conexión creada a la Base de Datos
    function CerrarConexion()
    {
        $this->mysqli->close();
    }
}

///////////////////////////////////////////////////////////////////////////////////////////