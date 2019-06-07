<?php 
require_once('../bd/bd.php');
require_once('funcoesphp/funcoesPadrao.php');
$conexao = conexaoMysql("bd_locadora_w");




$value_btn = "CRIAR NOVO MODELO";
$formAction="filme-categoria.php";



if (isset($_GET["cadastrar_categoria"])){
    
    $categoria = $_GET["cod_categoria"];
    $subCategoria = $_GET["cod_sub_categoria"];
    $filme = $_GET["cod_filme"];
    $sql = "INSERT INTO tbl_categoria_sub_filme (cod_categoria, cod_filme, cod_sub_categoria) VALUES ($categoria, $filme, $subCategoria);";
    
    if(mysqli_query($conexao, $sql)){
        //echo ('<script>alert("Cadastrado!"); window.location.href ="filme-categoria.php";</script>');
    }
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
    <form action="<?php echo $formAction ?>" enctype="multipart/form-data" method="get">
        <details  <?php  echo(isset($_GET['editar'])==true?"open":"close") ?>>
            <summary class="novo-conteudo" >Adicionar Categoria e Sub Categoria a um Filme</summary>
                <div class="caixa-cadastro center">
                    <div class="linha-01">
                        <div class="ln-01" >
                            Filme
                        </div>
                        <div class="ln-01">
                            Categoria
                        </div>    
                        <div class="ln-01">
                            Sub Categoria
                        </div>                                
                        <div class="linha-01">
                            <select  name="cod_filme"   class="txt-01" required>
                                <option value="">Escolha um Filme</option>
                                <?php 
                                $sql = "SELECT cod_filme, titulo_filme from tbl_filme;";
                                $nome ="";
                                $select = mysqli_query($conexao, $sql);
                                while($rs =  mysqli_fetch_array($select)){
                                    $value = $rs['cod_filme'];
                                    $nome = $rs['titulo_filme'];
                                    $selected = $codFilmeAtual == $rs['cod_filme']?"selected":"";
                                    echo "<option value='$value' $selected >$nome</option>";
                                } 
                            ?>
                            </select>
                            <select  name="cod_categoria"   class="txt-01" required>
                                <option value="">Escolha uma Categoria</option>
                                <?php 
                                $sql = "SELECT * FROM tbl_categoria";
                                $nome ="";
                                $select = mysqli_query($conexao, $sql);
                                while($rs =  mysqli_fetch_array($select)){
                                    $value = $rs['cod_categoria'];
                                    $nome = $rs['nome_categoria'];
                                    $selected = $codFilmeAtual == $rs['cod_filme']?"selected":"";
                                    echo "<option value='$value' >$nome</option>";
                                } 
                            ?>
                            </select>
                            <select  name="cod_sub_categoria"   class="txt-01" required>
                                <option value="">Escolha uma Sub-Categoria</option>
                                <?php 
                                $sql = "SELECT * FROM tbl_sub_categoria";
                                $nome ="";
                                $select = mysqli_query($conexao, $sql);
                                while($rs =  mysqli_fetch_array($select)){
                                    $value = $rs['cod_sub_categoria'];
                                    $nome = $rs['nome_sub_categoria'];
                                    $selected = $codFilmeAtual == $rs['cod_filme']?"selected":"";
                                    echo "<option value='$value' >$nome</option>";
                                } 
                            ?>
                            </select>
                        </div>
                        
                    <div class="linha2" style="margin-top: 350px;">
                        <!-- sem limite de tamanho -->
                        <input type="submit" value="Cadastrar Categoria" name="cadastrar_categoria" class="btn-input"> 
                        
                        <input type="button" value="PREVIEW" class="previl">
                    </div>
                </div> 
        </details>
    </form> 
    
   <div class="caixa-verificacao center">
    <!-- <div class="contatos center"> 
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
    </div> -->
</div>

<?php include('footer.php') ?>  
</body>
</html>