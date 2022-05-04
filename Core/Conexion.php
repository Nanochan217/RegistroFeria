<?php
     class Conexion
     {
         private $mysqli;

         //Método para abrir una nueva conexión a la Base de Datos con una Consulta (Query)
         function NuevaConexion($query)
         {
             $usuario = "root";
             $contrasena = "";
             $db = "id18869247_feriavocacional";//Nombre de la Base de Datos

             if(!$this->mysqli = new mysqli('localhost', $usuario, $contrasena, $db))
             {
                 //Mensaje de error en caso de que no se logre realizar la conexión
                 die('Error de conexion (' . mysqli_connect_errno() . ') '
                     . mysqli_connect_error());
             }

             $this->mysqli->autocommit(TRUE);
             $respuestaDB = $this->mysqli->query($query);
             return $respuestaDB;
         }

         function CerrarConexion()
         {
             $this->mysqli->close();
         }
     }