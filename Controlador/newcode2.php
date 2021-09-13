<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['submit']) && !empty($_POST['newcode']) && !empty($_POST['idclaseimprimir'])){


    require_once '../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
    //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
    $newcode=$_POST["newcode"];
    $id = $_POST['newcodeidmateria']; 
    $id_clase = $_POST['idclaseimprimir'];

    $mysql = new MySQL;//nuevo mysql
    $mysql->conectar();//funcion almacenada en mysql.php
    //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas

    $sql=$mysql->efectuarConsulta("UPDATE asistencia.clase SET codigo ='".$newcode."' WHERE Materia_id_materia = ".$id." and id_clase = ".$id_clase."");
    //condicion donde si la consulta se hace correcto
    if($sql){
        //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
        echo"<script type=\"text/javascript\">alert('Se actualizo correctamente'); window.location='../clases_vistas.php';</script>";

    }else{
        //mensaje de salida en caso de que la consulta falle
        echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../clases_vistas.php';</script>";
    }
    
     
}
?>