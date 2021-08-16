<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['submit']) && !empty($_POST['nombre_materia'])){

        require_once '../../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $materia=$_POST["nombre_materia"];
        $ides = $_GET['id']; 

        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas

        $sql=$mysql->efectuarConsulta("UPDATE asistencia.materia SET nombre ='".$materia."' WHERE id_materia = ".$ides."");
        //condicion donde si la consulta se hace correcto
        if($sql){
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Se actualizo correctamente'); window.location='../../index.php';</script>";

        }else{
            //mensaje de salida en caso de que la consulta falle
            echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../../update_materias.php';</script>";
        }
        
         
}
?>