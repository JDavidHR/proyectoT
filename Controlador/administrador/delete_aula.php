<?php

    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../../Modelo/MySQL.php';
    
    
    $id_aula = $_GET['id_aula'];
  
    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();
    //ejecucion de la consulta a la base de datos
    $sql = $mysql->efectuarConsulta("UPDATE asistencia.aula SET estado = 0 WHERE id_aula = ".$id_aula."");
    //Se valida si la consulta arrojo algun valor
    if($sql){
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se elimino correctamente'); window.location='../../gestion_aulas.php';</script>";
   
    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../index.php';</script>";
    }
    $mysql->desconectar();   

?>