


<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once('funcoesphp/funcoesPadrao.php');
$conexao = conexaoMysqlFunction("bd_locadora_w");

$tituloFilme ="";
$dataLancamento ="";
$diretor  ="";
$nacionalidade  ="";
$descricaoOficial = "";
$resumoFilme="";
$informacaoComplementar ="";
$preco="";
$descricaoOficia = "";
$form = "produtos.php";
$valueBtn = "Adicionar Filme";
$imagemFilme= "required";
$abertoOuFechadoEm = "close";


if(isset($_GET["editar"])){
    $cod=$_GET["editar"] ;
    $sqlBusca = "SELECT * FROM tbl_filme as filme inner join tbl_diretor as diretor on diretor.cod_diretor = filme.cod_diretor WHERE cod_filme = ". $cod;
  
    $s  = mysqli_query($conexao, $sqlBusca );
    $f =  mysqli_fetch_array($s);
    $tituloFilme =$f["titulo_filme"];
    $dataLancamento =$f["dt_lancamento"];
    $diretor  =$f["nome_diretor"];
    $nacionalidade  =$f["naciomanlidade"];
    $descricaoOficial = $f["descricao_oficial"];
    $resumoFilme=$f["resumo_filme"];
    $informacaoComplementar =$f["informacao_complementar"];
    $preco = $f["preco_filme"];
    $form = "produtos.php?editando=".$cod;
    $valueBtn = "Editar Filme";
    $imagemFilme= "";
    $abertoOuFechadoEm = "open";

}

if(isset($_GET["editando"])){
    $abertoOuFechadoEm = "open";
    $tituloFilme = $_POST["titulo-filme"];
    $dataLancamento =$_POST["data-lacancamento"];
    $diretor  =$_POST["diretor"];
    $nacionalidade  = $_POST["nacionalidade"];
    $descricaoOficial = $_POST["descricao-oficial"];
    $resumoFilme=$_POST["resumo-filme"];
    $informacaoComplementar =$_POST["informacao-complementar"];
    $preco=$_POST["perco"];
    $cod = $_GET["editando"];

    $slqDiretor = "INSERT INTO `tbl_diretor`
    (`nome_diretor`,
    `sexo`)
    VALUES (
    '".$diretor."', 'F');";
    if(mysqli_query($conexao, $slqDiretor)){
        $selectCodDiretor = "SELECT max(cod_diretor) from tbl_diretor";
        $diretor = mysqli_query($conexao , $selectCodDiretor);
        $diretor =  mysqli_fetch_array($diretor);
        $diretor = $diretor[0];
        echo $diretor;
        echo("<script>alet('2');</script>");
    }else{
        $diretor = 1;
    }
    $arquivo = $_FILES["img"]["name"];
    if(!empty($arquivo)){
        $arquivo = $_FILES["img"]["name"];
        $tamanho_arquivo = $_FILES["img"]["size"];
        $arquivo_temp = $_FILES["img"]["tmp_name"];
        $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        $sql = "UPDATE `tbl_filme`
                SET
                `titulo_filme` = '".$tituloFilme."',
                `dt_lancamento` = '".$dataLancamento."',
                `naciomanlidade` = '".$nacionalidade."',
                `resumo_filme` = '".$resumoFilme."',
                `img_primaria` = '".$img."',
                `descricao_oficial` = '".$descricaoOficial."',
                `informacao_complementar` = '".$informacaoComplementar."',
                `preco_filme` = '".$preco."',
                `cod_diretor` = '".$diretor."'
                WHERE `cod_filme` = '".$cod."';";

    }else{
        $sql = "UPDATE `tbl_filme`
        SET
        `titulo_filme` = '".$tituloFilme."',
        `dt_lancamento` = '".$dataLancamento."',
        `naciomanlidade` = '".$nacionalidade."',
        `resumo_filme` = '".$resumoFilme."',
        `descricao_oficial` = '".$descricaoOficial."',
        `informacao_complementar` = '".$informacaoComplementar."',
        `preco_filme` = '".$preco."',
        `cod_diretor` = '".$diretor."'
        WHERE `cod_filme` = '".$cod."';";
                
    }
    
    echo $sql;
    if(mysqli_query($conexao, $sql)){
        echo("<script>alert('Filme Atualizado'); window.location.href ='produtos.php';</script>");
    }else{
        echo("<script>alert('Eroo ao atualizar');</script>");
        //echo("<script>alert('Erro ao atualizar produto.'); window.location.href = 'produtos.php';</script>");
    }
    


    
}

if(isset($_POST["bnt_salvar"]) && !isset($_GET["editando"])){
    $arquivo = $_FILES["img"]["name"];
    $tamanho_arquivo = $_FILES["img"]["size"];
    $arquivo_temp = $_FILES["img"]["tmp_name"];
    $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);


    echo("<script>alet('1');</script>");
    $tituloFilme = $_POST["titulo-filme"];
    $dataLancamento =$_POST["data-lacancamento"];
    $diretor  =$_POST["diretor"];
    $nacionalidade  = $_POST["nacionalidade"];
    $descricaoOficial = $_POST["descricao-oficial"];
    $resumoFilme=$_POST["resumo-filme"];
    $informacaoComplementar =$_POST["informacao-complementar"];
    $preco=$_POST["perco"];


    $slqDiretor = "INSERT INTO `tbl_diretor`
    (`nome_diretor`,
    `sexo`)
    VALUES (
    '".$diretor."', 'F');";
    if(mysqli_query($conexao, $slqDiretor)){
        $selectCodDiretor = "SELECT max(cod_diretor) from tbl_diretor";
        $diretor = mysqli_query($conexao , $selectCodDiretor);
        $diretor =  mysqli_fetch_array($diretor);
        $diretor = $diretor[0];
      
    }else{
        $diretor = 1;
    }
  
    $sql = "INSERT INTO `tbl_filme`
    (`titulo_filme`,
    `dt_lancamento`,
    `naciomanlidade`,
    `resumo_filme`,
    `img_primaria`,
    `descricao_oficial`,
    `informacao_complementar`,
    `ativo`,
    `preco_filme`,
    `cod_diretor`,
    `click`)
    VALUES
    ('".$tituloFilme."',
    '".$dataLancamento."',
    '".$nacionalidade."',
    '".$resumoFilme."',
    '".$img."',
    '".$descricaoOficial."',
    '".$informacaoComplementar."',
    0,
    $preco,
    '".$diretor."',
    0);";
   

    if(mysqli_query($conexao, $sql)){
        echo("<script>alert('Filme Salvo'); window.location.href = 'produtos.php';</script>");
    }

}

if(isset($_GET['atualizar'])){
    $codigo =  $_GET['atualizar'];
    ativarOutroRegistroOutro($codigo, "tbl_filme", "produtos.php", "cod_filme");
}

 if(isset($_GET['codigo_excluir'])){
    $codigo = (int) ($_GET['codigo_excluir']);
    $sql="delete from tbl_categoria_sub_filme where cod_filme =".$codigo;
    mysqli_query($conexao, $sql);

    apagarRegistroCampo($codigo, "tbl_filme","produtos.php", "cod_filme");
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Conteudos</title>
<script language='JavaScript'>
        
   
    function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
        else  return false;
        }
    }
</script>
</head>
<body>
    <script src="../js/jquery.js"></script>
    
    
    
<?php include('header.php') ?>
<div class="conteudo-tabelas-adm center">


    
    <div class="caixa_de_ops">
        <a href="categoria.php" class="bnt_produtos">Nova Categoria</a>
        <a href="filme-categoria.php" class="bnt_produtos">Adicionar Categoria</a>
        
    </div>
    <details <?php echo $abertoOuFechadoEm ?>>
        <summary class="novo-conteudo"> Novo Conteudo</summary>
        
        <form action="<?php echo $form ?>" enctype="multipart/form-data" method="post">
            <div class="caixa-cadastro90 center">
                    <div class="linha90">
                            <div class="linha-01">
                                <div class="ln-01">
                                    Titulo Do Filme:
                                </div>
                                <div class="ln-01" >
                                    Data de Lançamento:

                                </div>
                                <div class="ln-01">
                                    Diretor:
                                </div>                                
                            <div class="linha-01">
                                <textarea  class="txt-01" name="titulo-filme" id="" maxlength="80" required><?php echo($tituloFilme) ?></textarea> <!-- 80 caracteres -->
                                <input type="date"  id="" class="txt-01" name="data-lacancamento" maxlength="300" value="<?php echo($dataLancamento) ?>" required><!-- intro da historia ate 314 caracteres -->
                                <textarea id="" class="txt-01" name="diretor" maxlength="36000" required><?php echo($diretor) ?></textarea>
                            </div>
                            <div class="ln-01">
                                    Nacionalidade:
                                </div>
                                <div class="ln-01">
                                    Descrição Ofical:
                                </div>
                                <div class="ln-01">
                                    Resumo do filme:
                                </div>
                            </div>
                            <div class="linha-01">
                                <textarea id="" class="txt-01" name="nacionalidade" required><?php echo($nacionalidade) ?></textarea>
                                <!--  disabled="disabled" -->
                                <textarea name="descricao-oficial" id="" style="height:200px; width: 370px; margin-left: 30px;" class="txt-069" required><?php echo($descricaoOficial) ?></textarea>
                                <textarea name="resumo-filme" id="" style="height:200px; width: 370px; margin-left: 30px;" class="txt-069" required><?php echo($resumoFilme) ?></textarea>
                            </div>
                            
                            <div class="linha-060">
                                <input type="file" <?php echo $imagemFilme ?> id="img_filme" name="img" class="txt-01"style="margin-left: 600px;" id="flImg">
                                <textarea name="informacao-complementar" placeholder="Informação complementar" id="" style="height:400px; " class="txt-06" required><?php echo($informacaoComplementar) ?></textarea>
                                <textarea id="" class="txt-01" name="perco" maxlength="7" placeholder="Preco filme R$" type='text' onkeypress='return SomenteNumero(event)'  required><?php echo($preco) ?></textarea>
                                
                            </div>
                        </div>
                            <div class="linha2">
                                <!-- sem limite de tamanho  -->
                                <input type="submit" value="<?php echo $valueBtn ?>" name="bnt_salvar" class="btn-input"> 
                                <input type="button" value="PREVIEW" class="previl">
                            </div>
                </div>
            </form>
            
    </details>
    <div class="caixa-verificacao center">
        <div class="contatos center">
            <div class="titulo-contatos" style="width:10%">ID</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Nome Do Filme</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
            
            

            <?php 

                $sql ="SELECT * FROM tbl_filme";
                $select = mysqli_query($conexao, $sql);
                while($rs = mysqli_fetch_array($select)){

                
            ?>
                <div class="resultados-do-banco">
                        <div class="info-status-id">
                        <?php echo $rs["cod_filme"] ?>
                        </div>

                        <div class="info-status-descrition-6666">
                            <?php echo $rs["titulo_filme"] ?>
                        </div>
                        
                        <div class="ops-contato-conteudo">
                            <a href="produtos.php?codigo_excluir=<?php echo $rs["cod_filme"] ?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')">
                                <img src="img/delete.png" alt="deletar" title="deletar" class="lupa">
                            </a>&nbsp&nbsp
                            <a href="produtos.php?editar=<?php echo$rs['cod_filme'] ?>">
                                <img src="img/ic_editar.png" alt="editar" title="editar">
                            </a>&nbsp&nbsp
                            <a href="produtos.php?atualizar=<?php echo $rs["cod_filme"] ?>" onclick="return confirm('CONFIRMAR ATUALIZAÇÃO DO REGISTRO?')"><img src="<?php  echo ($rs['ativo']==0?"img/false.png": "img/true.png") ?>" alt="" title=""></a>
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