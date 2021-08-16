<?php

    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../../Modelo/MySQL.php';
    
    
    $id_materia = $_GET['id_materia'];
 
    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();
    //ejecucion de la consulta a la base de datos
    $sql = $mysql->efectuarConsulta("UPDATE asistencia.materia SET estado = 1 WHERE id_materia = ".$id_materia."");
    //Se valida si la consulta arrojo algun valor
    if($sql){
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se activo correctamente'); window.location='../../gestion_materias.php';</script>";
        //echo $estudiante;
    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../index.php';</script>";
    }
    $mysql->desconectar();   

?>