


<?php 
    session_status();
    require_once('../bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");
    $txtNome="";
    $txtEmail ="";
    $txtUsuario="";
    $txtNivel="";
    $txtSenha="";
    $id=0;
    $modo = "Criar Usuario";
    

    if(isset($_POST['btn-salvar'])){
            $nome = $_POST["nome"];
            $senha = $_POST["senha"];
            $usuario = $_POST["usuario"];
            $email= $_POST["email"];
            $nivel = $_POST["nivel"];
            $sqlCreate = "INSERT INTO tbl_usuario (nome, email, senha, nivel_adm, usuario, ativo)
            values (
                '".$nome."',
                '".$email."',
                '".$senha."',
                '".$nivel."',
                '".$usuario."',
                0
            );";


            $id = $_GET['id']/22;
            $sqlAtualizar = "UPDATE  tbl_usuario SET nome ='".$nome."',
                email= '".$email."',
                senha = '".$senha."',
                nivel_adm='".$nivel."',
                usuario='".$usuario."' WHERE cod_usuario =".$id.";";

        if(isset($_GET['metodo']) == false){
            
        
            if(mysqli_query($conexao, $sqlCreate)){
                echo ("<script>alert('Registro Salvo!'); window.location.href='usuario.php';</script>");
            }else{
                echo ("<script>alert('ERRO NO CADASTRO!'); </script>");

            }
        }else if(isset($_GET['metodo']) && $_GET['metodo'] == "editar"){
        
            if(mysqli_query($conexao, $sqlAtualizar)){
                echo ("<script>alert('Registro Atualizado!'); window.location.href='usuario.php';</script>");
            }else{
                echo ("<script>alert('ERRO NA ATUALIZAÇÃOS!'); </script>");

            }
            

        }
    }

    if(isset($_GET["metodo"])){
        $metodo = $_GET["metodo"];

        if($metodo =="excluir"){
            @$codigo  = $_GET['id']/22;
            $sqlVerificacao = "SELECT * FROM tbl_usuario WHERE cod_usuario =".$codigo.";";
            $rsVerificacao = mysqli_fetch_array(mysqli_query($conexao, $sqlVerificacao));

            if($rsVerificacao["ativo"] == 0){
                $codigo = int;
                @$codigo  = $_GET['id']/22;
                @$sql = "DELETE FROM tbl_usuario WHERE cod_usuario =".$codigo.";";
                if(mysqli_query($conexao, $sql)){
                    echo ("<script>alert('Registro Excluido'); window.location.href='usuario.php';</script>");
                }else{
                    echo ("<script>alert('ERRO! Registro Não Excluido'); window.location.href='usuario.php'; </script>");

                }
            }else{
                echo ("<script>alert('POR FAVOR DESATIVE O USUARIO PARA EXCLUIR!'); window.location.href='usuario.php'; </script>");

            }
        }

        if($metodo =='editar'){
            @$codigo  = $_GET['id']/22;
            @$sql = "SELECT * FROM tbl_usuario WHERE cod_usuario =".$codigo.";";
            $rsUsuario = mysqli_fetch_array(mysqli_query($conexao, $sql));
            $txtNome=$rsUsuario["nome"];
            $txtEmail =$rsUsuario["email"];
            $txtUsuario=$rsUsuario["usuario"];
            $txtNivel=$rsUsuario["nivel_adm"];
            $txtSenha=$rsUsuario["senha"];   
            $id=$rsUsuario["cod_usuario"];    
            $modo = "Editar Usuario";

        }
        if($metodo == 'ativo'){

            $sqlverificacao= "SELECT count(cod_usuario) as total from tbl_usuario where ativo=1";
           $selectVerificacao = mysqli_fetch_array(mysqli_query($conexao, $sqlverificacao));
           

            @$id = $_GET["id"]/22;
            @$sql = "SELECT * FROM tbl_usuario WHERE cod_usuario =".$id.";";
            $rsUsuario = mysqli_fetch_array(mysqli_query($conexao, $sql));
            $sqlAtivo="";
            if($rsUsuario["ativo"] == 0){
                $sqlAtivo = "UPDATE tbl_usuario set ativo=1 WHERE cod_usuario='".$id."';";
                mysqli_query($conexao, $sqlAtivo);
            }else{
                if($selectVerificacao["total"] >1){
                    $sqlAtivo = "UPDATE tbl_usuario set ativo=0 WHERE cod_usuario='".$id."';"; 
                    mysqli_query($conexao, $sqlAtivo);     
                }else{
                echo ("<script> alert('NÃO PERMITIDO! AO MENOS UM DEVE ADM DEVE PERMANECER ATIVO.');</script>");

                }
            }
              echo ("<script>window.location.href='usuario.php'; </script>");


        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Conteudos</title>
</head>
<body>
<?php include('header.php') ?>
<div class="conteudo-tabelas-adm center">



    <details <?php  echo(isset($_GET['metodo'])==true && $_GET['metodo'] =="editar"?"open":"close") ?>>
        <summary class="novo-conteudo" >Novo usuario</summary>
        <div class="caixa-cadastro-users center">
            
            <table class="center tabela-usuario" border=1>
                <?php $action = $modo == "Criar Usuario"?"usuario.php":"usuario.php?metodo=editar&id=".$id*22. ?>
                <form action="<?php echo $action ?>" method="post">
                <tr class="colunas">
                        <td>
                            Nome:
                        </td>
                        <td>
                            E-mail:
                        </td>
                    
                    </tr>
                    <tr class="colunas margin-bo">
                        <td>
                            <input type="text" required name="nome"  placeholder="digite o nome do usuario..." value="<?php echo $txtNome ?>">
                        </td>
                        <td>
                        <input type="email" required name="email"  placeholder="digite o E-mail do usuario..." value="<?php echo $txtEmail ?>">
                            
                        </td>
                    
                    </tr>
                    <tr class="colunas">
                        <td>
                            Usuario Para Acesso:
                        </td>
                        <td>
                            Nível de Usuario:
                        </td>
                    
                    </tr>
                    <tr class="colunas margin-bo">
                        <td>
                        <input type="text" required name="usuario"  placeholder="digite um usuario para poder acessar..." value="<?php echo $txtUsuario ?>">
                        </td>
                        <td>
                        <?php 
                            $adm = $txtNivel == "1"?"selected":"";
                            $ctlg = $txtNivel == "2"?"selected":"";
                            $operadorBasico = $txtNivel == "3"?"selected":"";
                        ?>
                        <select class="input-contato" name="nivel" id="nivel" required>  <option value="1" <?php echo $adm ?>>1- Adiministrador</option><option value="2" <?php echo $ctlg ?>>2- Cataloguista </option> <option value="3" <?php echo $operadorBasico; ?> >3- Operador Básico</option></select>               
                        </td>
                    
                    </tr>
                    
                    <tr class="colunas">
                        <td>
                            Senha 
                        </td>
                        <td>
                            Confirmação de Senha
                        </td>
                    
                    </tr>
                    
                    <tr class="colunas margin-bo">
                        <td>
                        <input type="password" required name="senha" id="senha" placeholder="Digite a senha..." value="<?php echo $txtSenha ?>">
                        
                        </td>
                        <td>
                        <input type="password" id="confirm-sen" required  placeholder="Confirme sua senha...">
                            
                        </td>
                    
                    </tr>
                    <tr  class="colunas">
                        <td colspan="2" class="linha-coluna">
                            <input type="submit" value="<?php echo $modo?>" name="btn-salvar" class="btn-usuario" onclick="return validarCamposUsers()">
                        </td>
                    </tr>
                </form>  
            </table>
            
        </div>
            
    </details>
    
    <div class="caixa-verificacao center">
    <div class="contatos center">
            <div class="titulo-contatos" style="width:10%">ID</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:35%">nome</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:35%">Nível</div>

            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
            
                <?php 


                    $sql= "SELECT * FROM tbl_usuario";
                    $select = mysqli_query($conexao, $sql);

                    // enquanto o rsJogos receber uma lista (array) 
                    while($rsUsers = mysqli_fetch_array($select)){

                ?>
                    <div class="resultados-do-banco">
                        
                            <div class="info-status-id">
                                <?php echo $rsUsers['cod_usuario'] ?>
                            </div>

                            <div class="info-status-descrition-2">
                                <?php echo $rsUsers['nome'] ?>
                            </div>
                            <div class="info-status-descrition-2">
                                <?php 
                                $nivel = $rsUsers["nivel_adm"];
                                    if($rsUsers["nivel_adm"] == "1"){
                                        echo "ADMINISTRADOR";
                                    }else if($rsUsers["nivel_adm"] ==  "2"){
                                            echo "CATALOGISTA";
                                    }else{
                                        echo "OPERADOR BASICO";
                                    }
                                 ?>
                            </div>
                            
                            <div class="ops-contato-conteudo">
                                
                            <a href="usuario.php?id=<?php echo($rsUsers['cod_usuario']*22) ?>&metodo=excluir" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')"><img src="img/delete.png" alt="deletar" title="deletar" class="lupa"></a>&nbsp &nbsp 
                            <a href="usuario.php?id=<?php echo($rsUsers['cod_usuario']*22) ?>&metodo=editar"><img src="img/ic_editar.png" alt="editar" title="editar"></a> &nbsp &nbsp
                            <?php $title= $rsUsers['ativo']==0?"Ativar Usuario": "Desativar Usuario";?>
                            <a href="usuario.php?id=<?php echo($rsUsers['cod_usuario']*22) ?>&metodo=ativo"><img src="<?php  echo ($rsUsers['ativo']==0?"img/false.png": "img/true.png") ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" style="cursor:pointer;"></a>
                                
                            </div>

                    
                    </div> 
                <?php
                    }
                ?>
                
           
        </div>
    </div>

    
</div>

<?php include('footer.php') ?>  
<script src="js/vaalidacoes.js"></script>
</body>
</html>