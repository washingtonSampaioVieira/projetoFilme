


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
$_SESSION["modo"]=0;


if(isset($_GET['modo_edit'])){
    $value_btn = "ATUALIZAR MODELO";
    $id=$_GET['modo_edit']/22;
    $sql = "SELECT * FROM tbl_ator_do_mes WHERE cod =".$id.";";
    $atora = mysqli_fetch_array(mysqli_query($conexao, $sql));
    $nomeAutor= $atora['titulo_nome_ator'];
    $historiaAutor= $atora['historia_ator'];
    $biografiaAutor= $atora['biografia_ator'];
    $fotoAutor= $atora['img_primaria'];
    $fotoPersonagem= $atora['img_personagem'];
    $caixa_requirida = " ";
    
    $nomeBtn= "btn_atualizar";
}else{
    $caixa_requirida = "required";
    $nomeBtn= "btn_gravar";
}
echo ("<script>alert(".$caixa_requirida.")</script>");




$caixa_requirida = "required";
if(isset($_POST['btn_atualizar'])){
    $nomeAutor = $_POST['nome-autor'];
    $biografiaAutor = $_POST['biografia-autor'];
    $historiaAutor = $_POST['historia-autor'];
    $id = $_GET['id']/22;



    $rs =mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM tbl_ator_do_mes where cod = $id;"));
    $fotoPrimaria = $rs['img_primaria'];
    $fotoSecundaria = $rs['img_personagem'];
    if(!empty($_FILES["img1"]["name"]) && !empty($_FILES["img2"]["name"])){
        
        $arquivo = $_FILES["img1"]["name"];
        $tamanho_arquivo = $_FILES["img1"]["size"];
        $arquivo_temp = $_FILES["img1"]["tmp_name"];
        $fotoAutor = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        

        $arquivo = $_FILES["img2"]["name"];
        $tamanho_arquivo = $_FILES["img2"]["size"];
        $arquivo_temp = $_FILES["img2"]["tmp_name"];
        $fotoPersonagem = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

        apagarFoto($fotoPrimaria);
        apagarFoto($fotoSecundaria);

        $sql = "UPDATE tbl_ator_do_mes 
        SET 
            titulo_nome_ator = '".$nomeAutor."',
            historia_ator = '".$historiaAutor."',
            img_primaria = '".$fotoAutor."',
            ativo = 0,
            img_personagem = '".$fotoPersonagem."',
            biografia_ator = '".$fotoAutor."'
        WHERE
            cod = $id;";
    }elseif(!empty($_FILES["img1"]["name"])){
            

        $arquivo = $_FILES["img1"]["name"];
        $tamanho_arquivo = $_FILES["img1"]["size"];
        $arquivo_temp = $_FILES["img1"]["tmp_name"];
        $fotoAutor = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
    
        apagarFoto($fotoPrimaria);
        $sql = "UPDATE tbl_ator_do_mes 
        SET 
            titulo_nome_ator = '".$nomeAutor."',
            historia_ator = '".$historiaAutor."',
            img_primaria = '".$fotoAutor."',
            ativo = 0,
            biografia_ator = '".$fotoAutor."'
        WHERE
            cod = $id;";
    }elseif(!empty($_FILES["img2"]["name"])){
        

        $arquivo = $_FILES["img2"]["name"];
        $tamanho_arquivo = $_FILES["img2"]["size"];
        $arquivo_temp = $_FILES["img2"]["tmp_name"];
        $fotoPersonagem = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        apagarFoto($fotoSecundaria);
                
        $sql = "UPDATE tbl_ator_do_mes 
        SET 
            titulo_nome_ator = '".$nomeAutor."',
            historia_ator = '".$historiaAutor."',
            ativo = 0,
            img_personagem = '".$fotoPersonagem."'
        WHERE
            cod = $id;";
    }else{
        echo ("<script>alert('sem as duas fotos') ;</script>");      
        $sql = "UPDATE tbl_ator_do_mes 
        SET 
            titulo_nome_ator = '".$nomeAutor."',
            historia_ator = '".$historiaAutor."',
            ativo = 0
        WHERE
            cod = $id;";
    }            
    if(mysqli_query($conexao, $sql)){
        echo ("<script>alert('atualizado');window.location.href='ator-do-mes-adm.php'; ;</script>");            
    }else{
        echo ("<script>alert('REGISTRO ATIVO NÃO PODE SER ATUALIZADO');</script>");
        echo ($sql);   
    }
}
if(isset($_POST['btn_gravar'])){
    $nomeAutor = $_POST['nome-autor'];
    $biografiaAutor = $_POST['biografia-autor'];
    $historiaAutor = $_POST['historia-autor'];
    $arquivo = $_FILES["img1"]["name"];
    $tamanho_arquivo = $_FILES["img1"]["size"];
    $arquivo_temp = $_FILES["img1"]["tmp_name"];
    $img1 = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

    $arquivo = $_FILES["img2"]["name"];
    $tamanho_arquivo = $_FILES["img2"]["size"];
    $arquivo_temp = $_FILES["img2"]["tmp_name"];
    $img2 = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);


    $fotoAutor = $img1;
    $fotoPersonagem = $img2;
    echo ("<script>alert($fotoAutor);</script>");    
    echo ("<script>alert($fotoPersonagem);</script>");    
            // arrumar
    $sql = "INSERT INTO  tbl_ator_do_mes (titulo_nome_ator,
     historia_ator,
      img_primaria, 
     img_personagem, 
     biografia_ator, 
     ativo) 
    VALUES ('".$nomeAutor."', 
    '".$historiaAutor."', 
    '".$fotoAutor."', 
    '".$fotoPersonagem."',
    '".$biografiaAutor."', 
    0) ;";
    echo ("<script>alert($sql);</script>");    

    if(mysqli_query($conexao, $sql)){
        echo ("<script>alert('Salvo');window.location.href='ator-do-mes-adm.php';</script>");    
    }else{
    echo ("<script>alert('ERRO');window.location.href='ator-do-mes-adm.php';</script>");    
    }

}



if(isset($_GET['codigo_excluir']) && isset($_GET['modo'])){
    $codigo = (int) ($_GET['modo']/22);
    apagarRegistro($codigo, "tbl_ator_do_mes","ator-do-mes-adm.php");
}


if(isset($_GET['codigo_atualizar']) && isset($_GET['modo'])){
   $codigo =  $_GET['modo']/22;
   ativarRegistro($codigo, "tbl_ator_do_mes", "ator-do-mes-adm.php");
   
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



    <details  <?php  echo(isset($_GET['modo_edit'])==true?"open":"open") ?>>
        <summary class="novo-conteudo" >Novo Conteudo</summary>

            <div class="caixa-cadastro center"  style="height: 860px;">
                <div class="linha1">
                        <div class="linha-titulo">
                            <div class="ln-01" >
                                Nome do personagem do mês
                            </div>
                            <div class="ln-01" style="margin-left: 200px;">
                                História do ator
                            </div>
                        </div>
                        <form action="ator-do-mes-adm.php?id=<?php echo ($id*22) ?>" enctype="multipart/form-data" method="post">
                            <textarea  class="txt-1" name="nome-autor" id="" required maxlength="35"><?php echo trim($nomeAutor) ?></textarea> <!-- 80 caracteres -->
                            
                            <textarea  id="" class="txt-2" name="historia-autor"required maxlength="200"><?php echo(trim($historiaAutor))?></textarea><!-- intro da historia ate 314 caracteres -->
                    </div>
                            <div class="linha2"  style="height: auto;">
                            <div class="linha-titulo">
                                <div class="col100">
                                    Biografia do ator
                                </div>
                            </div>
                            <div class="linha-titulo">
                            <textarea id="" class="txt-3-2" name="biografia-autor" maxlength="36000" required>
                                <?php echo  ($biografiaAutor) ?> 
                            </textarea>
                            <div class="col2-2">
                                Foto do ator (400x500).
                            </div>
                            <div class="col2-2">
                                Foto do ator (750x450).
                            </div>
                            </div>
                            <!-- sem limite de tamanho -->
                            <input type="file" name="img1" <?php //echo ($caixa_requirida); ?> class="txt-01"style="margin-left: 100px;" id="flImg">
                            <input type="file" name="img2" <?php //echo ($caixa_requirida); ?>  class="txt-01"style="margin-left: 350px;" id="flImg">
                            <input type="submit" value="<?php echo $value_btn; ?>" name="<?php echo $nomeBtn ?>" class="btn-input"> 
                        </form>
                    <input type="button" value="PREVIEW" class="previl">
                </div>
                
            </div>
    </details>
    
    <div class="caixa-verificacao center">
    <div class="contatos center">
            <div class="titulo-contatos" style="width:10%">ID</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Nome Do Ator</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
            
            <?php
                while($rsLista = mysqli_fetch_array($select)){
            ?>
                <div class="resultados-do-banco">
                    
                        <div class="info-status-id">
                        <?php echo $rsLista['cod'] ?>
                        </div>

                        <div class="info-status-descrition-6666">
                            <?php echo $rsLista['titulo_nome_ator'] ?>
                        </div>
                        
                        <div class="ops-contato-conteudo">
                            
                        <a href="ator-do-mes-adm.php?codigo_excluir=<?php echo $rsLista['cod'] ?>&modo=<?php echo $rsLista["cod"]*22?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')">
                            <img src="img/delete.png" alt="deletar" title="deletar" class="lupa">
                        </a>&nbsp &nbsp 

                        <a href="<?php echo ($rsLista['ativo']==1?'ator-do-mes-adm.php':'ator-do-mes-adm.php?btn_gravar='.$rsLista['cod'].'&modo_edit='.$rsLista['cod']*22);?>">
                            <img src="img/ic_editar.png" alt="editar" title="editar">
                        </a> &nbsp &nbsp
                        <?php  $title = $rsLista['ativo']==0?"img/false.png": "img/true.php" ?>
                            <a href="ator-do-mes-adm.php?codigo_atualizar=<?php echo $rsLista['cod'] ?>&modo=<?php echo $rsLista["cod"]*22?>" onclick="return confirm('CONFIRMAR ATUALIZAÇÃO DO REGISTRO?')"><img src="<?php  echo ($rsLista['ativo']==0?"img/false.png": "img/true.png") ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>"></a>
                        
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