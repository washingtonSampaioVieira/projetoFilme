


<?php 

    require_once('../bd/bd.php');
    require_once('funcoesphp/funcoesPadrao.php');
    $conexao = conexaoMysql("bd_locadora_w");

    $sql ='select * from tbl_quem_somos;';
    $historiaEmpresa = "";
    $introHistoria = "";
    $focoDaEmpresa = "";
    $select = mysqli_query($conexao, $sql);
    $value_btn = "CRIAR NOVO MODELO";
    $_SESSION["modo"]=0;
    $id="";
    if(isset($_GET['modo_edit'])){
        $value_btn="ATUALIZAR NOVO MODELO";
        $codigo =$_GET['modo_edit']/22;
        $id = $codigo*21;
        $sql = "SELECT * FROM tbl_quem_somos WHERE cod=".$codigo.";";
        $rsMostrar= mysqli_fetch_array(mysqli_query($conexao, $sql));
        $focoDaEmpresa = $rsMostrar['foco_da_empresa'];
        $introHistoria = $rsMostrar['intro_historia'];
        $historiaEmpresa = $rsMostrar['texto_historia_empresa'];
        $_SESSION["modo"]=1;
        $nomeBtn= "btn_atualizar";

    }else{
        $nomeBtn="btn_gravar";
    }

    if(isset($_POST['btn_gravar'])){


        $arquivo = $_FILES["img"]["name"];
        $tamanho_arquivo = $_FILES["img"]["size"];
        $arquivo_temp = $_FILES["img"]["tmp_name"];
        $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

        $focoDaEmpresa = $_POST['foco-da-empresa'];
        $introHistoria = $_POST['intro-historia'];
        $historiaEmpresa = $_POST['historia-empresa'];
        $logo = "img/logo.png";
        // echo "<script>alert('gravar');</script>";
        
            $sqlInsert = "INSERT INTO  tbl_quem_somos (foco_da_empresa, intro_historia, texto_historia_empresa, nome_img, ativo)
            values ('".$focoDaEmpresa."', '".$introHistoria."', '".$historiaEmpresa."','".$img."',0);";
            if(mysqli_query($conexao, $sqlInsert)){
                //echo ("<script>alert('Registro salvo.');window.location.href='quem-somos-adm.php';</script>");  
            }else{
                //echo ("<script>alert('ERRO AO GRAVAR.');window.location.href='quem-somos-adm.php';</script>");
            }
        
            
    }

    if(isset($_POST['btn_atualizar'])) {
        $id = $_GET['id']/21;
        $focoDaEmpresa = $_POST['foco-da-empresa'];
        $introHistoria = $_POST['intro-historia'];
        $historiaEmpresa = $_POST['historia-empresa'];

        $sqlCod ='select * from tbl_quem_somos where cod='.$id.';';
        $selectCod = mysqli_query($conexao, $sqlCod);  
        $rsCod = mysqli_fetch_array($selectCod);
        if($rsCod['cod'] == $id && $rsCod['ativo'] == 0){

            if(!empty($_FILES["img"]["name"])){
                
                $rs = mysqli_fetch_array(mysqli_query($conexao, $sql));

                apagarFoto( "cms/" . $rsCod['nome_img']);
                $arquivo = $_FILES["img"]["name"];
                $tamanho_arquivo = $_FILES["img"]["size"];
                $arquivo_temp = $_FILES["img"]["tmp_name"];
                $img = uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo);

echo ("<script>alert('".$img."')</script>");  
                $sqlUpdate = "UPDATE tbl_quem_somos SET foco_da_empresa = '".$focoDaEmpresa."', intro_historia = '".$introHistoria."', texto_historia_empresa = '".$historiaEmpresa."', nome_img='".$img."', ativo = 0 WHERE cod =".$id.";";
                echo ("<script>alert('Registro atualizado com foto.')</script>");  
            }else{
                $sqlUpdate = "UPDATE tbl_quem_somos SET foco_da_empresa = '".$focoDaEmpresa."', intro_historia = '".$introHistoria."', texto_historia_empresa = '".$historiaEmpresa."', ativo = 0 WHERE cod =".$id.";";
                echo ("<script>alert('Registro atualizado sem foto.')</script>");  
            }
            
            if(mysqli_query($conexao, $sqlUpdate)){
                //echo ("<script>alert('Registro atualizado.');window.location.href='quem-somos-adm.php';</script>");  
            }else{
                //echo ("<script>alert('ERRO AO ATUALIZAR.');window.location.href='quem-somos-adm.php';</script>");
            }
        }else{
            echo ("<script>alert('REGISTRO ATIVO NÃO PODE SER ATUALIZADO');</script>");            

        }
    }

    if(isset($_GET['codigo_excluir']) && isset($_GET['modo'])){
        $codigo = (int) ($_GET['modo']/22);
        apagarRegistro($codigo, "tbl_quem_somos", "quem-somos-adm.php");
    }

    if(isset($_GET['codigo_atualizar']) && isset($_GET['modo'])){ 
       $codigo =  $_GET['modo']/22;
       ativarRegistro($codigo, "tbl_quem_somos", "quem-somos-adm.php");
    }
?>


<!DOCTYPE html>
<html lang="pt  ">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Conteudos</title>
</head>
<body>
    <?php include('header.php') ?>
    <div class="conteudo-tabelas-adm center">



        <details <?php  echo(isset($_GET['modo_edit'])==true?"open":"close") ?>>
            <summary class="novo-conteudo" >Novo Conteudo</summary>

                <div class="caixa-cadastro center" style="height: 800px;">
                    <div class="linha1">
                            <div class="linha-titulo">
                                <div class="col1">
                                    Foco da Empresa até 90 caracter:
                                </div>
                                <div class="col2">
                                    História da empresa até 314 caracter:

                                </div>
                            </div>
                            <form action="quem-somos-adm.php?id=<?php echo $id ?>" enctype="multipart/form-data" method="post">
                            <textarea  class="txt-1" name="foco-da-empresa" id="" required maxlength="80">
                                <?php echo $focoDaEmpresa ?>
                            </textarea> <!-- 80 caracteres -->
                            
                            <textarea  id="" class="txt-2" required name="intro-historia" maxlength="300">
                                <?php echo $introHistoria ?>  
                            </textarea><!-- intro da historia ate 314 caracteres -->
                        </div>
                        <div class="linha2" style="height: auto;">
                        <div class="linha-titulo">
                                <div class="col2">
                                    Escreva a História da empresa ou um texto. (principal).
                                </div>
                                <div class="col1">
                                    Foto (logo empresa).
                                </div>
                            </div>
                            <textarea id="" class="txt-3" name="historia-empresa" maxlength="36000" required>
                                <?php echo $historiaEmpresa ?> 
                            </textarea><!-- sem limite de tamanho -->
                            <input type="file" name="img" required class="txt-01"style="margin-left: 10px;" id="flImg">
                           
                            <input type="submit" value="<?php echo $value_btn; ?>" name="<?php echo $nomeBtn; ?>" class="btn-input"> 
                        </form>
                        <input type="button" value="PREVIEW" class="previl">
                    </div>
                    
                </div>
        </details>
        
        <div class="caixa-verificacao center">
        <div class="contatos center">
                <div class="titulo-contatos" style="width:10%">ID</div>
                <div class="titulo-contatos" style="border-left: solid 1px black;width:70%">Descrição da loja</div>
                <div class="titulo-contatos" style="border-left: solid 1px black;width: 20%;">OPS</div>
                
                <?php
                    while($rsLista = mysqli_fetch_array($select)){
                ?>
                    <div class="resultados-do-banco">
                        
                            <div class="info-status-id">
                            <?php echo $rsLista['cod'] ?>
                            </div>

                            <div class="info-status-descrition-6666">
                                <?php echo $rsLista['foco_da_empresa'] ?>
                            </div>
                            
                            <div class="ops-contato-conteudo">
                                
                            <a href="quem-somos-adm.php?codigo_excluir=<?php echo $rsLista['cod'] ?>&modo=<?php echo $rsLista["cod"]*22?>" onclick="return confirm('CONFIRMAR EXCLUSÃO DO REGISTRO?')"><img src="img/delete.png" alt="deletar" title="deletar" class="lupa"></a>&nbsp &nbsp 
                            <a href="<?php echo ($rsLista['ativo']==1?"#":"quem-somos-adm.php?btn_gravar=".$rsLista['cod']."&modo_edit=".$rsLista["cod"]*22); ?>"><img src="img/ic_editar.png" alt="editar" title="editar"></a> &nbsp &nbsp
                            <?php  $title = $rsLista['ativo']==0?"img/false.png": "img/true.php" ?>
                                <a href="quem-somos-adm.php?codigo_atualizar=<?php echo $rsLista['cod']*22 ?>&modo=<?php echo $rsLista["cod"]*22?>" onclick="return confirm('CONFIRMAR ATUALIZAÇÃO DO REGISTRO?')"><img src="<?php  echo ($rsLista['ativo']==0?"img/false.png": "img/true.png") ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>"></a>
                            
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