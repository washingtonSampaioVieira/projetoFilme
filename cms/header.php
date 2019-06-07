<?php 
    session_start();
    if($_SESSION['logado'] == false){
        echo ("<script>window.location.href='../index.php';</script>");
    }
    
    require_once('funcoesphp/funcoesPadrao.php');
    $conexao = conexaoMysqlFunction("bd_locadora_w");

    $sql = "select * from tbl_usuario where cod_usuario = '".$_SESSION['cod_user_logado']."';";
    
    $rsUser = mysqli_fetch_array(mysqli_query($conexao, $sql));


    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
?>



<header id="header-adm">
        <section id="topo-pg-adm" class="center" >
            <h1><span>CMS</span> - Sistema de Gerenciamento do Site</h1>
            <figure class="logo-grande-top">
                <a href="index.php"><img src="img/logo-adm.png" alt="Logo da Empresa" title="Acne"></a>
            </figure>
        </section>
        <nav class="nav-adm center">
            <ul class="tabela-menu-config"> 


                <?php
                    if($rsUser["nivel_adm"]== 1 || $rsUser["nivel_adm"] ==3 ){
                ?>

                    <li class="menu_itens-config">
                    <a href="conteudo.php"> <img src="img/conteudo.png" alt=""></a><br>
                        Conteúdo
                    </li>

                    <li class="menu_itens-config">
                        <a href="contato.php"> <img src="img/contato.png" alt=""></a><br>
                            Contato
                    </li>
                <?php } ?> 
                <?php
                    if($rsUser["nivel_adm"]== 1  || $rsUser["nivel_adm"] == 2){
                ?>
                      
                    <li class="menu_itens-config">
                    <a href="produtos.php"><img src="img/produtos.png" alt=""><br></a>
                            Produtos
                    </li>
                <?php } ?> 
                <?php
                    if($rsUser["nivel_adm"]== 1 || $rsUser["nivel_adm"] ==3 ){
                ?>
                    <li class="menu_itens-config">
                    <a href="usuario.php"> <img src="img/usuarios.png" alt=""></a><br>
                            Usuários
                    </li>
                <?php } ?> 
                
                




            </ul>
            <div class="usuario-logado">
                Bem vindo<?php echo (" - ".$_SESSION['nome']); ?>.<br>
               <a href="sair.php"> Logout</a>
            </div>
            
        </nav>
        </header>