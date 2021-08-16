<?php

    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../../modelo/MySQL.php';
    
    $id_estudiante = $_GET['id_estudiante'];
    
    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();


    //ejecucion de la consulta a la base de datos
    $sql = $mysql->efectuarConsulta("UPDATE asistencia.estudiante SET estado = 1 WHERE id_estudiante = ".$id_estudiante."");
    //Se valida si la consulta arrojo algun valor
    if($sql){
        //mensaje de salida (alert) cuando la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se activo correctamente'); window.location='../../gestion_estudiante.php';</script>";

    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../index_administrador.php';</script>";
    }
    $mysql->desconectar();   

?>