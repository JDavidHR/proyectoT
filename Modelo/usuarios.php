<?php
//creacion de la clase usuarios
    class usuarios{
        //declaro las variables
        private $documento;
        private $pass;
        private $tipo_usuario;
               
        //metodos get de las variables y sus returns
        function getdocumento() {
            return $this->documento;
        }

        function getpass() {
            return $this->pass;
        }

        function gettipo_usuario() {
            return $this->tipo_usuario;
        }
        
        //metodos sets de las variables y sus asignaciones
        function setdocumento($documento) {
            $this->documento = $documento;
        }

        function setpass($pass) {
            $this->pass = $pass;
        }

        function settipo_usuario($tipo_usuario) {
            $this->tipo_usuario = $tipo_usuario;
        }
    }