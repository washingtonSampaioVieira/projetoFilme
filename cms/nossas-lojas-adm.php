


<?php 


require_once('funcoesphp/funcoesPadrao.php');
$conexao = conexaoMysqlFunction("bd_locadora_w");


$value_btn = "CRIAR NOVO MODELO";
$id=0;
$_SESSION["modo"]=0;

$nome_loja = "";
$logradouro = "";
$bairro = "";
$numero= "";
$estadoLoja="";
$cidade="Selecione um cidade";
$historia_loja="";
$codCidade="";
$nomeBtn= "btn_salvar";
$caixa = "close";
$imgLoja ="";
$formAction="nossas-lojas-adm.php";

if(isset($_GET["editar"])){
    $id=$_GET["editar"];

    $sql = "SELECT 
    loja.cod_loja,
    loja.titulo_loja,
    loja.texto_loja,
    loja.foto_loja,
    endereco.cod_endereco,
    endereco.nome_rua,
    endereco.numero,
    cidade.nome_cidade,
    estado.nome_estado,
    estado.cigla,
    endereco.bairro,
    cidade.cod_cidade,
    loja.foto_loja
FROM
    tbl_loja AS loja
        INNER JOIN
    tbl_endereco AS endereco ON endereco.cod_endereco = loja.cod_endereco
        INNER JOIN
    tbl_cidade AS cidade ON cidade.cod_cidade = endereco.cod_cidade
        INNER JOIN
    tbl_estado AS estado ON estado.cod_estado = cidade.cod_estado where loja.cod_loja =".$id.";";
    $rs = mysqli_fetch_array(mysqlI_query($conexao, $sql));


    $nome_loja = $rs["titulo_loja"];
    $id=$rs["cod_loja"];
    $logradouro = $rs["nome_rua"];
    $bairro = $rs["bairro"];
    $numero= $rs["numero"];
    $estadoLoja=$rs["nome_estado"];
    $cidade=$rs["nome_cidade"];
    $historia_loja=$rs["texto_loja"];
    $value_btn = "ATUALIZAR LOJA";
    $caixa = "open";
    $codCidade=$rs["cod_cidade"];
    $nomeBtn= "btn_atualizar";
    $imgLoja =$rs["foto_loja"];
    $formAction="nossas-lojas-adm.php?editando=".$id; 
}



if(isset($_GET['editando'])){

    $id = $_GET["editando"];
    $nome_loja = $_POST["nome-loja"];
    $logradouro = $_POST["logradouro"];
    $bairro = $_POST["bairro"];
    $numero= $_POST["numero"];
    $estado=$_POST["slcEstado"];
    $cidade=$_POST["slcCidade"];
    $historia_loja=$_POST["historia-loja"];

    if(!empty($_FILES["img"]["name"])){

        $nome_foto = mysqli_fetch_array(mysqli_query($conexao, "select foto_loja from tbl_loja where cod_loja =".$id.";"));

        $nome_foto = $nome_foto['foto_loja'];
        apagarFoto($nome_foto);
        $arquivo = $_FILES["img"]["name"];
        $tamanho_arquivo = $_FILES["img"]["size"];
        $arquivo_temp = $_FILES["img"]["tmp_name"];
        $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
        $sql =  "INSERT INTO `tbl_endereco` ( `nome_rua` ,`numero` ,`bairro`, `cod_cidade`)  VALUES ($logradouro,$numero,$numero,$cidade);";
        $sql2="    UPDATE `tbl_loja`
                    SET `titulo_loja` = '".$nome_loja."',
                    `texto_loja` ='".$historia_loja."',
                    `foto_loja` = '".$img."',
                    `cod_endereco` = (select max(cod_endereco) from tbl_endereco)
                    WHERE `cod_loja` = '".$id."';";

        
    }else{
       $sql =  "INSERT INTO `tbl_endereco` ( `nome_rua` ,`numero` ,`bairro`, `cod_cidade`)  VALUES ('".$logradouro."',$numero,'".$bairro."',$cidade);";
       $sql2="UPDATE `tbl_loja`
                    SET `titulo_loja` = '".$nome_loja."',
                    `texto_loja` ='".$historia_loja."',
                    `cod_endereco` = (select max(cod_endereco) from tbl_endereco)
                    WHERE `cod_loja` = '".$id."';";
      
    }
    echo ( "<script>alert('Registro Atualizado!')</script>" );

    // mysqli_multi_query($conexao, $sql);
    mysqli_query($conexao, $sql);
    mysqli_query($conexao, $sql2);

    //header("location: nossas-lojas-adm.php");
}



if(isset($_GET["ativo"])){
    $codigo =  $_GET['ativo'];
    ativarOutroRegistro($codigo, "tbl_loja", "nossas-lojas-adm.php","cod_loja");
}
if(isset($_GET["deletar"])){
    $id=$_GET["deletar"];
    $banco = "tbl_loja";
    $pg="nossas-lojas-adm.php";
    $campo="cod_loja";  
    echo "deletar";
    apagarRegistroCampo($id, $banco, $pg, $campo);
}



if (isset($_POST["btn_salvar"])){
    $nome_loja = $_POST["nome-loja"];
    $logradouro = $_POST["logradouro"];
    $bairro = $_POST["bairro"];
    $numero= $_POST["numero"];
    $estado=$_POST["slcEstado"];
    $cidade=$_POST["slcCidade"];
    
    $historia_loja=$_POST["historia-loja"];
    
    
    $arquivo = $_FILES["img"]["name"];
    $tamanho_arquivo = $_FILES["img"]["size"];
    $arquivo_temp = $_FILES["img"]["tmp_name"];

    $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);
    if($img != false){
        $sql = "INSERT INTO tbl_endereco (nome_rua, numero, bairro, cod_cidade) VALUES ('".$logradouro."','".$numero."','".$bairro."','".$cidade."');";
        if(mysqli_query($conexao, $sql)){
            $cod_endereco = mysqli_fetch_array(mysqli_query($conexao, "Select max(cod_endereco) as cod from tbl_endereco;"));
            $cod_endereco = $cod_endereco["cod"];
            $sql = "INSERT INTO tbl_loja (`titulo_loja`,`texto_loja`,`foto_loja`, `cod_endereco`,`ativa`) VALUES
            ( '".$nome_loja."','".$historia_loja."', '".$img."','".$cod_endereco."',0);";
            if(mysqli_query($conexao, $sql)){
                echo ("<script>alert('Registro Gravado!');window.location.href='nossas-lojas-adm.php'</script>"); 
            }else{
                echo ("<script>alert('Erro cadastro de loja!');window.location.href='nossas-lojas-adm.php'</script>"); 
            }

        }else{
            echo ("<script>alert('Erro cadastro de endereco da loja!');window.location.href='nossas-lojas-adm.php'</script>"); 
        }
    }else{
        echo ("<script>alert('Erro ao salvar foto! Verifique Se a foto foi anexada.');window.location.href='nossas-lojas-adm.php'</script>"); 

    }   

}




?>


<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Conteudos</title>
</head>
<body>
    <script src="../js/jquery.js"></script>
    <script>

        $(document).ready(function() {
            $('#slcEstado').change(function(){
                 
                    $.ajax({
                    url: "cidade.php",
                    type: "POST",
                    data: {cod:document.getElementById("slcEstado").value},
                    dataType: "html",
                        success:function(dados) {
                            $("#slcCidade").html(dados);
                            console.log(dados)

                        }
                    });
            });


        });


       
    
    </script>
<?php include('header.php') ?>
<div class="conteudo-tabelas-adm center">



    <details <?php echo($caixa) ?> >
        <summary class="novo-conteudo" >Novo Conteudo</summary>
        
        <form action="<?php echo($formAction) ?>" enctype="multipart/form-data" method="post">
            <div class="caixa-cadastro center">
                    <div class="linha1">
                            <div class="linha-01">
                                <div class="ln-01">
                                    Nome da loja:
                                </div>
                                <div class="ln-01" >
                                Logradouro:

                                </div>
                                <div class="ln-01">
                                    Bairro:
                                </div>                                
                            <div class="linha-01">
                                <textarea  class="txt-01" name="nome-loja" id="" maxlength="80" required><?php echo $nome_loja ?></textarea> <!-- 80 caracteres -->
                                <textarea  id="" class="txt-01" name="logradouro" maxlength="300" required><?php  echo $logradouro ?></textarea><!-- intro da historia ate 314 caracteres -->
                                <textarea id="" class="txt-01" name="bairro" maxlength="36000" required><?php echo $bairro ?></textarea>
                            </div>
                            <div class="ln-01">
                                    Número:
                                </div>
                                <div class="ln-01">
                                    Estado:
                                </div>
                                <div class="ln-01">
                                    Cidade:
                                </div>
                            </div>
                            <div class="linha-01">
                                <textarea id="" class="txt-01" name="numero" required> <?php echo $numero ?> </textarea>
                                <!--  disabled="disabled" -->
                                <select name="slcEstado" class="txt-01" id="slcEstado" required ><option value="">Selecione um Estado</option>
                                    <?php
                                        $sqlEstados = "SELECT * FROM tbl_estado;";
                                        $select = mysqli_query($conexao, $sqlEstados);
                                        while($rsEstado = mysqli_fetch_array($select)){
                                            $cod = $rsEstado['cod_estado'];
                                            $estado = $rsEstado['nome_estado'];
                                            $selected = $estado == $estadoLoja? "selected": " ";
                                            print_r("<option value='$cod' $selected >$estado</option>");
                                        }
                                    
                                    ?>
                                </select>
                                <select name="slcCidade" class="txt-01" id="slcCidade" required><option value="<?php echo $codCidade ?>"><?php echo $cidade ?></option></select>
                            </div>
                            <div class="txt-06">
                                Hitória e Foto da loja

                            </div>
                            <div class="linha-06">
                                <input type="file" name="img" <?php echo($nomeBtn =="btn_salvar"?"required":" "); ?> class="txt-01"style="margin-left: 400px;" id="flImg">
                                <textarea name="historia-loja" id="" style="height:400px; " class="txt-06" required><?php echo $historia_loja ?></textarea>
                                <div class="txt-06"  style="height:400px;"><img src="<?php echo($imgLoja) ?>" class="tamanho_mae" alt="img" title="img"></div>
                            </div>
                        </div>
                            <div class="linha2">
                                <!-- sem limite de tamanho -->
                                <input type="submit" value="<?php echo $value_btn; ?>" name="<?php echo $nomeBtn ?>" class="btn-input"> 
                                
                                <input type="button" value="PREVIEW" class="previl">
                            </div>
                </div>
            </form>
            
    </details>

    <div class="caixa-verificacao center">
    <div class="contatos center">
            <div class="titulo-contatos" style="width:10%">ID</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Descrição da loja</div>
            <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
                

                <?php 
                    $sql = "SELECT * FROM tbl_loja;";
                    $select =mysqli_query($conexao, $sql);
                       while($rsLojas = mysqli_fetch_array($select)){        
                ?>
                    <div class="resultados-do-banco">
                        <div class="info-status-id">
                            <?php echo $rsLojas["cod_loja"]; ?>
                        </div>

                        <div class="info-status-descrition-6666">
                            <?php echo $rsLojas["titulo_loja"]; ?>
                        </div>
                        
                        <div class="ops-contato-conteudo">
                            <a href="nossas-lojas-adm.php?deletar=<?php echo($rsLojas['cod_loja']); ?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')"><img src="img/delete.png" alt="deletar" title="deletar" class="lupa"></a>&nbsp &nbsp 
                            <a href="nossas-lojas-adm.php?editar=<?php echo($rsLojas['cod_loja']); ?>"><img src="img/ic_editar.png" alt="editar" title="editar"></a> &nbsp &nbsp
                            <a href="nossas-lojas-adm.php?ativo=<?php echo($rsLojas['cod_loja']); ?>" onclick="return confirm('CONFIRMAR ATUALIZAÇÃO DO REGISTRO?')"><img src="img/<?php echo($rsLojas["ativa"] == 1?"true.png":"false.png") ?>" alt="" title=""></a>
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