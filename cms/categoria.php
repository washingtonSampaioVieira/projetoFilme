<?php 
require_once('../bd/bd.php');
require_once('funcoesphp/funcoesPadrao.php');
$conexao = conexaoMysql("bd_locadora_w");




$value_btn = "CRIAR NOVO MODELO";
$formAction="categoria.php";
$nomeDaCategoria = "";
if(isset($_GET['editar'])){
    $value_btn = "ATUALIZAR MODELO";
    $nomeBtn= "btn_atualizar";
}else{
    $nomeBtn= "btn_gravar";
}



if (isset($_POST["btn_gravar"])){
    $nomeCategoria=$_POST["nome_categoria"];
    $sql = "INSERT INTO tbl_categoria (nome_categoria) VALUES ('".$nomeCategoria."');";
    
    if(mysqli_query($conexao, $sql)){
        echo ('<script>alert("Salvo!");window.location.href="categoria.php";</script>');
    }else{
        echo ('<script>alert("erro ao salvar");</script>');
    } 
}
if(isset($_GET['editar'])){
    $cod = $_GET["editar"];
    $sql = "SELECT * FROM tbl_categoria WHERE cod_categoria = ".$cod;
    
    $rs = mysqli_fetch_array(mysqli_query($conexao, $sql));
    $nomeDaCategoria = $rs["nome_categoria"];
    $formAction="categoria.php?editando=".$rs["cod_categoria"];
}

if(isset($_POST['btn_atualizar'])){ 
    $cod = $_GET["editando"];
    $nomeCategoria = $_POST["nome_categoria"];
    $sql = "UPDATE tbl_categoria set nome_categoria ='".$nomeCategoria."' WHERE cod_categoria = ".$cod;
    
    if(mysqli_query($conexao, $sql)){
        echo ('<script>alert("Atualizado");window.location.href="categoria.php";</script>');
    }else{
        echo ('<script>alert("erro ao atualizar");</script>');
    }
}
if(isset($_GET["deletar"])){
    $id=$_GET["deletar"];
    $banco = "tbl_categoria";
    $pg="categoria.php";
    $campo="cod_categoria";  
    apagarRegistroCampo($id, $banco, $pg, $campo);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Promoções</title>
</head>
<body>
<?php include('header.php') ?>
<div class="conteudo-tabelas-adm center">

    <div class="caixa_de_ops">
        <a href="produtos.php" class="bnt_produtos">Voltar</a>
    </div>
    <form action="<?php echo $formAction ?>" enctype="multipart/form-data" method="post">
        <details  <?php  echo(isset($_GET['editar'])==true?"open":"close") ?>>
            <summary class="novo-conteudo" >Nova Categoria</summary>
                <div class="caixa-cadastro center">
                    <div class="linha-01">
                        <div class="ln-01" >
                            Nome da Categoria
                        </div>
                        <div class="ln-01">
                            
                        </div>    
                        <div class="ln-01">
                            
                        </div>                                
                    <div class="linha-01">
                        <input type="text" name="nome_categoria" value = "<?php echo $nomeDaCategoria ?>" require class="txt-01" required maxlength="15">
                        </select>
                    </div>
                    <div class="linha2" style="margin-top: 350px;">
                        <!-- sem limite de tamanho -->
                        <input type="submit" value="<?php echo $value_btn; ?>" name="<?php echo $nomeBtn ?>" class="btn-input"> 
                        
                        <input type="button" value="PREVIEW" class="previl">
                    </div>
                </div> 
        </details>
    </form> 
    
    <div class="caixa-verificacao center">
    <div class="contatos center">
            <div class="titulo-contatos" style="width:10%">ID</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Categoria</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
            <?php 
                $sql = "select * from tbl_categoria;";
                $select= mysqli_query($conexao, $sql);                                
                while ($rs = mysqli_fetch_array($select)){
                    $nome=$rs['nome_categoria'];
                    $cod=$rs["cod_categoria"];
            ?>
                <div class="resultados-do-banco">
                        <div class="info-status-id">
                        <?php echo($cod) ?>
                        </div>
                        <div class="info-status-descrition-6666">
                            <?php echo($nome) ?>
                        </div>
                        
                        <div class="ops-contato-conteudo">
                            <a href="categoria.php?deletar=<?php echo $rs["cod_categoria"] ?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')">
                                <img src="img/delete.png" alt="deletar" title="deletar" class="lupa">
                            </a>&nbsp &nbsp
                            <a href="categoria.php?editar=<?php echo$rs['cod_categoria'] ?>">
                                <img src="img/ic_editar.png" alt="editar" title="editar">
                            </a>
                        </div>
                </div> 
            <?php
                } 
            ?>
        </div>
    </div>
</div>

<?php include('footer.php') ?>  
</body>
</html>