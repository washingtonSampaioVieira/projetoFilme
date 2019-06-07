<?php 
require_once("bd/bd.php");
$conexao = conexaoMysql("bd_locadora_w");
session_start();
if(isset($_POST["login"])){
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $sql = "SELECT count(cod_usuario) as total, nome as nome, cod_usuario FROM tbl_usuario WHERE usuario='".$usuario."' AND senha='".$senha."' AND ativo='1';";
    $rsUsuario = mysqli_fetch_array(mysqli_query($conexao, $sql));
    if($rsUsuario["total"] == 1){
        $_SESSION['nome'] = $rsUsuario['nome'];
        $_SESSION['logado']= true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['cod_user_logado'] = $rsUsuario["cod_usuario"];
        echo ("<script>window.location.href='cms/index.php';</script>");
    }else{
        $_SESSION['logado']=false;
        echo ("<script>alert('USUARIO OU SENHA INCORRETO.'); window.location.href='index.php';</script>");
    }
}

?>