<?php
//condicion donde se rectifica que los campos no esten vacios y que esten definidos
if(isset($_POST['submit']) && !empty($_POST['inlineRadioOptions']) && !empty($_POST['documento_usuario']) && !empty($_POST['nombre_usuario']) && !empty($_POST['apellido_usuario']) && !empty($_POST['tipousuario']) && !empty($_POST['Semestre']) && !empty($_POST['clave']) && !empty($_POST['correo']) && !empty($_POST['carrera']) ){

        require_once '../modelo/MySQL.php';//se llama la pagina mysql.php para hacer la respectiva conexion con la BD
        //declaracion de las variables donde se almacenan los datos de los respectivos campos llenados del formulario metodo post
        $documento=$_POST["documento_usuario"];
        $nombre=$_POST["nombre_usuario"];
        $apellido=$_POST["apellido_usuario"];
        $semestre=$_POST["Semestre"];
        $clave=$_POST["clave"];
        $correo=$_POST["correo"];
        $tipo=$_POST["tipousuario"];
        $carrera=$_POST["carrera"];
        $jornada=$_POST["inlineRadioOptions"];
        
        $mysql = new MySQL;//nuevo mysql
        $mysql->conectar();//funcion almacenada en mysql.php
        //consulta de la insercion de datos en la base de datos, donde hace las respectivas consultas
        $sql=$mysql->efectuarConsulta("insert into asistencia.estudiante(documento,nombres,apellidos,jornada,semestre,clave,correo,Carrera_id_carrera,tipo_usuario_id_tipo_usuario,estado) VALUES ('".$documento."','".$nombre."','".$apellido."','".$jornada."','".$semestre."','".$clave."','".$correo."','".$carrera."','".$tipo."',1)");
        //condicion donde si la consulta se hace correcto
        if($sql){
            //mensaje de salida (alert) cuanod la consulta es exitosa con su respectiva redireccion de pagina
            echo"<script type=\"text/javascript\">alert('Se registro correctamente'); window.location='../index.php';</script>";

        }else{
            //mensaje de salida en caso de que la consulta falle
            echo"<script type=\"text/javascript\">alert('Se produjo un error'); window.location='../registro_usuario.php';</script>";
        }
        
         
}
?>