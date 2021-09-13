<?php

    //Archivo requerido para hacer las peticiones a la base de datos
    require_once '../Modelo/MySQL.php';
    
    
    $id_docente = $_GET['id_docente'];

    $mysql = new MySQL(); //se declara un nuevo array
    $mysql->conectar();
    //ejecucion de la consulta a la base de datos
    $sql = $mysql->efectuarConsulta("UPDATE asistencia.docente SET estado = 0 WHERE id_docente = ".$id_docente."");
    //Se valida si la consulta arrojo algun valor
    if($sql){
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se elimino correctamente'); window.location='../gestion_docente.php';</script>";

    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../ndex.php';</script>";
    }
    $mysql->desconectar();   

?>