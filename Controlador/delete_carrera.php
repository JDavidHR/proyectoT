<?php

    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../Modelo/MySQL.php';
    
    
    $id_carrera = $_GET['id_carrera'];

    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();
    //ejecucion de la consulta a la base de datos
    $sql = $mysql->efectuarConsulta("UPDATE asistencia.carrera SET estado = 0 WHERE id_carrera = ".$id_carrera."");
    //Se valida si la consulta arrojo algun valor
    if($sql){
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se elimino correctamente'); window.location='../gestion_carrera.php';</script>";
        //echo $estudiante;
    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../index.php';</script>";
    }
    $mysql->desconectar();   

?>