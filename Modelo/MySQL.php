<?php
//creacion de la clase MySQL

class MySQL{
    
    //Declaracion de variables de conexion
    private $hostname  = "localhost";
    private $user = "root";
    private $password = "";
    private $puerto = "3306";
    private $database = "asistencia";
    
    private $conexion;
    
    // Metodo para conectar a la base de datos
    public function conectar(){
        $this->conexion = mysqli_connect($this->hostname, $this->user, $this->password, $this->database);
    }
    
    //Metodo que cierra la conexion
    public function desconectar(){
        mysqli_close($this->conexion);
    }
    
    //Metodo que efectua una consulta devuelve su resultado
    public function efectuarConsulta($consulta){
        mysqli_query($this->conexion, "SET lc_time_names = 'es_ES'" ); 
        //Añade el uso de caracteres especiales como tildes con el formato utf8
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        mysqli_query($this->conexion, "SET CHARACTER 'utf8'");

        //ejecucion de la consulta
       $this->resultadoConsulta = mysqli_query($this->conexion, $consulta);
        //retorno del resultado de la consulta
        return $this->resultadoConsulta; 
    }
/*
    public function crearBackup(){
        include '../Controlador/funcionBackup.php';
        backDb($this->hostname, $this->user, $this->password, $this->database);
    }
    */
}