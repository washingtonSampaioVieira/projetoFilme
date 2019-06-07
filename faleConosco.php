<?php 

    require_once('bd/bd.php');

    if(isset($_GET["btn_gravar"])){

       $nome = $_GET["nome"]; 
       $telefone=$_GET["telefone"];
       $email=$_GET["email"];
       $celular = $_GET["celular"];
       $homePage = $_GET["home-page"];
       $linkFacebook=$_GET["facebook"];
       $profissao = $_GET["profissao"];
       $sexo = $_GET["sexo"];
       $sugestoes_criticas = $_GET["sugestoes-criticas"];
       $perguntas = $_GET["informacoes"];

       $conexao= conexaoMysql("bd_locadora_w");

       $sql="INSERT INTO tbl_contato (nome, telefone, email, celular,
             home_page, link_facebook, profissao, sexo, sugestoes_criticas, perguntas) 
        VALUES ('".$nome."', '".$telefone."', '".$email."', '".$celular."','".$homePage."',
        '".$linkFacebook."', '".$profissao."','".$sexo."','".$sugestoes_criticas."','".$perguntas."');";
        if(mysqli_query($conexao, $sql)){
            header("Location: fale-conosco.php?resp=true");
        }else{
            header("Location: fale-conosco.php?resp=true");
        }

       

    }else{
        header("Location: fale-conosco.php");
    }

    


?>