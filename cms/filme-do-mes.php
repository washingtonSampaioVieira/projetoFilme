<?php 
require_once('../bd/bd.php');
require_once('funcoesphp/funcoesPadrao.php');
$conexao = conexaoMysql("bd_locadora_w");




$sql ='select * from tbl_ator_do_mes;';
$nomeAutor= "";
$historiaAutor= "";
$biografiaAutor= "";
$fotoAutor= "";
$fotoPersonagem= "";
$select = mysqli_query($conexao, $sql);
$value_btn = "CRIAR NOVO MODELO";
$id=0;
$fotoPrimaria = "img/padrao.png";
$fotoSecundaria = "img/padrao.png";
$codFilmeAtual =0;
$_SESSION["modo"]=0;
$formAction="filme-do-mes.php";

if(isset($_GET['editar'])){
    $value_btn = "ATUALIZAR MODELO";
    $nomeBtn= "btn_atualizar";
}else{
    $nomeBtn= "btn_gravar";
}



if (isset($_POST["btn_gravar"])){
    $filme=$_POST["slcFilme"];
    
    
    $arquivo = $_FILES["img-1"]["name"];
    $tamanho_arquivo = $_FILES["img-1"]["size"];
    $arquivo_temp = $_FILES["img-1"]["tmp_name"];
    $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

    $arquivo = $_FILES["img-2"]["name"];
    $tamanho_arquivo = $_FILES["img-2"]["size"];
    $arquivo_temp = $_FILES["img-2"]["tmp_name"];
    $img2 = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

   


    
    if($img != false && $img2 != false){
        $sql = "INSERT INTO `tbl_filme_do_mes`
            (`img_primaria`,`img_fundo`, `ativo`,`cod_filme`)
             VALUES ('".$img."','".$img2."',0, $filme);";

            

        if(mysqli_query($conexao, $sql)){
            

        }else{
            echo ("erro ao salvar");
            //echo ("<script>alert('Erro cadastro de endereco da loja!');window.location.href='nossas-lojas-adm.php'</script>"); 
        }
       

    }

}
if(isset($_GET['editar'])){
    $cod = $_GET["editar"];
    $sql = "SELECT filme_mes.img_fundo, filme_mes.img_primaria , filme_mes.ativo , filme_mes.cod_filme_do_mes, filme.titulo_filme, filme.cod_filme from tbl_filme_do_mes as filme_mes inner join tbl_filme as filme on filme.cod_filme = filme_mes.cod_filme where filme_mes.cod_filme_do_mes=".$cod;
    $rs = mysqli_fetch_array(mysqli_query($conexao, $sql));
    $fotoPrimaria = $rs["img_primaria"];
    $fotoSecundaria = $rs["img_fundo"];
    $codFilmeAtual =$rs["cod_filme"];
    echo $fotoPrimaria;
    $formAction="filme-do-mes.php?editando=".$rs['cod_filme_do_mes'];
}

if(isset($_POST['btn_atualizar'])){
    echo "entrouuu";
    $cod = $_GET["editando"];
    $filme=$_POST["slcFilme"];
    $sql = "SELECT filme_mes.img_fundo, filme_mes.img_primaria , filme_mes.ativo , filme_mes.cod_filme_do_mes,
    filme.titulo_filme, filme.cod_filme from tbl_filme_do_mes as filme_mes
    inner join tbl_filme as filme on filme.cod_filme = filme_mes.cod_filme where filme_mes.cod_filme_do_mes =".$cod;
    $rs = mysqli_fetch_array(mysqli_query($conexao, $sql));
    $fotoPrimaria = $rs["img_primaria"];
    
    $fotoSecundaria = $rs["img_fundo"];
    
    

    if(!empty($_FILES["img-1"]["name"]) && !empty($_FILES["img-2"]["name"])){

        $arquivo = $_FILES["img-1"]["name"];
        $tamanho_arquivo = $_FILES["img-1"]["size"];
        $arquivo_temp = $_FILES["img-1"]["tmp_name"];
        $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        echo("<br>".$img."<br>");

        $arquivo = $_FILES["img-2"]["name"];
        $tamanho_arquivo = $_FILES["img-2"]["size"];
        $arquivo_temp = $_FILES["img-2"]["tmp_name"];
        $img2 = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

        apagarFoto($fotoPrimaria);
        apagarFoto($fotoSecundaria);

        $sql = "UPDATE `tbl_filme_do_mes`SET
        `img_primaria` ='".$img."',
        `img_fundo` = '".$img2."',
        `cod_filme` = '".$filme."'
        WHERE `cod_filme_do_mes` = $cod;";
    }elseif(!empty($_FILES["img-1"]["name"])){

        $arquivo = $_FILES["img-1"]["name"];
        $tamanho_arquivo = $_FILES["img-1"]["size"];
        $arquivo_temp = $_FILES["img-1"]["tmp_name"];
        $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
    
        apagarFoto($fotoPrimaria);
        $sql = "UPDATE `tbl_filme_do_mes`SET
        `img_primaria` ='".$img."',
        `cod_filme` = '".$filme."'
        WHERE `cod_filme_do_mes` = $cod;";
    }elseif(!empty($_FILES["img-2"]["name"])){
        

        $arquivo = $_FILES["img-2"]["name"];
        $tamanho_arquivo = $_FILES["img-2"]["size"];
        $arquivo_temp = $_FILES["img-2"]["tmp_name"];
        $img2 = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        apagarFoto($fotoSecundaria);

        $sql = "UPDATE `tbl_filme_do_mes`SET
        `img_fundo` = '".$img2."',
        `cod_filme` = '".$filme."'
        WHERE `cod_filme_do_mes` = $cod;";
    }else{
        $sql = "UPDATE `tbl_filme_do_mes`SET
        `cod_filme` = '".$filme."'
        WHERE `cod_filme_do_mes` = $cod;";
    }

    if(mysqli_query($conexao, $sql)){
        echo("<script>alert('Registro Atualizado'); window.location.href='filme-do-mes.php';</script>");
    }
}






if(isset($_GET["deletar"])){
    $id=$_GET["deletar"];
    $banco = "tbl_filme_do_mes";
    $pg="filme-do-mes.php";
    $campo="cod_filme_do_mes";  
    apagarRegistroCampo($id, $banco, $pg, $campo);
}


if(isset($_GET['atualizar'])){
   $codigo =  $_GET['atualizar'];
   ativarOutroRegistroAtivo($codigo, "tbl_filme_do_mes", "filme-do-mes.php", "cod_filme_do_mes");
}

    





?>


<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Ator do Mês</title>
</head>
<body>
<?php include('header.php') ?>
<div class="conteudo-tabelas-adm center">


    <form action="<?php echo($formAction) ?>" enctype="multipart/form-data" method="post">
        <details  <?php  echo(isset($_GET['editar'])==true?"open":"close") ?>>
            <summary class="novo-conteudo" >Novo Conteudo</summary>
                <div class="caixa-cadastro center">
                    <div class="linha-01">
                        <div class="ln-01">
                            Segunda Imagem
                        </div>
                        <div class="ln-01" >
                            Primeira Imagem

                        </div>
                        <div class="ln-01">
                            Selecione um filme
                        </div>                                
                    <div class="linha-01">
                        <input type="file" name="img-1" require id="img-1" class="txt-01">
                        <input type="file" name="img-2" id="img-2" require class="txt-01">
                        <select name="slcFilme" class="txt-01" id="slcFilme" required><option value="">Escolha um filme</option>
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
                    
                    <div class="caixa-auto">
                        <div class="foto-03">
                            <img src="<?php echo ($fotoPrimaria); ?>" alt="foto filme do mes" title="foto autor do mes" class="foto-100" alt="">
                        </div>
                        <div class="foto-03" >
                        <img src="<?php echo ($fotoSecundaria) ?>"  alt="foto filme do mes" title="foto autor do mes"class="foto-100" alt="">

                        </div>
                        <div class="foto-03">
                        </div>
                        
                    
                    
                    </div>
                    <div class="linha2">
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
            <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Nome Do Filme</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
            
            

            <?php 

                $sql ="SELECT titulo_filme, filme_mes.ativo , filme_mes.cod_filme_do_mes as cod_filme from tbl_filme_do_mes as filme_mes inner join tbl_filme as filme on filme.cod_filme = filme_mes.cod_filme;";
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
                            <a href="filme-do-mes.php?deletar=<?php echo $rs["cod_filme"] ?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')">
                                <img src="img/delete.png" alt="deletar" title="deletar" class="lupa">
                            </a>&nbsp&nbsp
                            <a href="filme-do-mes.php?editar=<?php echo$rs['cod_filme'] ?>">
                                <img src="img/ic_editar.png" alt="editar" title="editar">
                            </a>&nbsp&nbsp
                            <a href="filme-do-mes.php?atualizar=<?php echo $rs["cod_filme"] ?>" onclick="return confirm('CONFIRMAR ATUALIZAÇÃO DO REGISTRO?')"><img src="<?php  echo ($rs['ativo']==0?"img/false.png": "img/true.png") ?>" alt="" title=""></a>
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