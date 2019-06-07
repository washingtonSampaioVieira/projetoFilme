<?php

    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);

    function conexaoMysql($database){
        // mysql_connect() - bibloteca de coneção com o banco msql - vigente ate php 5.3
        // mysqlli()- bibloteca de coneção com o banco msql - vigente ate as versoes atuais
        // PDO() - bibloteca de coneção com o banco msql mais ultilizada em projetos orientado a objetos


        // variaveis pora passar argumentos
        // $conexao = null;
        // $server = "localhost";
        // $user = "root";
        // $password = "bcd127";   
        // $database="bd_locadora_w";

        $conexao = null;
        $server = "192.168.0.2";
        $user = "pc1820191";
        $password = "senai127";
        $database="dbpc1820191";

         

        // variavel que vai ter a conexao com o banco
        $conexao = mysqli_connect($server, $user,$password,$database);
        return $conexao;
    }

?>