<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['submit']) && !empty($_POST['documento_docente']) && !empty($_POST['nombre_docente']) && !empty($_POST['apellido_docente']) && !empty($_POST['contrasena']) && !empty($_POST['correo']) && !empty($_POST['tipousuario']) ){

        require_once '../Modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $documento=$_POST["documento_docente"];
        $nombre=$_POST["nombre_docente"];
        $apellido=$_POST["apellido_docente"];
        $pass=$_POST["contrasena"];
        $correo=$_POST["correo"];
        $tipo=$_POST["tipousuario"];

        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas
        $sql=$mysql->efectuarConsulta("insert into asistencia.docente(documento,nombres,apellidos,clave,correo,tipo_usuario_id_tipo_usuario,estado) VALUES ('".$documento."','".$nombre."','".$apellido."','".$pass."','".$correo."' ,'".$tipo."',1)");
        //condicion donde si la consulta se hace correcto
        if($sql){
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Se registro correctamente'); window.location='../index.php';</script>";

        }else{
            //mensaje de salida en caso de que la consulta falle
            echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../registro_docente.php';</script>";
        }
        
         
}
?>