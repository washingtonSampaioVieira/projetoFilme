<?php 

require_once('bd/bd.php');
$conexao = conexaoMysql("bd_locadora_w");

    $filme="";
    $diretor="";
    $nacionalidade="";
    $resumoDoFilme="";
    $descricaoOficial="";
    $fotoPrimaria="";
    $informacaoComplementar="";



    

    if(isset($_GET["local"])){
        
        $idLoja=$_GET["local"];
    }else{
        $sql = "select min(cod_loja) as cod from tbl_loja where ativa = 1";
        $rs =mysqli_fetch_array(mysqli_query($conexao,$sql));
        $idLoja = $rs['cod'];
    }
        $sql = "SELECT 
            filme.titulo_filme, filme.resumo_filme, filme_mes.img_primaria, filme.descricao_oficial,
            filme.informacao_complementar, filme_mes.img_fundo, filme.dt_lancamento, filme.naciomanlidade,
            diretor.nome_diretor, filme_mes.ativo
        FROM
            tbl_filme_do_mes as filme_mes
                INNER JOIN
            tbl_filme as filme ON filme.cod_filme = filme_mes.cod_filme
                INNER JOIN
            tbl_diretor as diretor ON diretor.cod_diretor = filme.cod_diretor
        WHERE
        filme_mes.ativo = 1;";
        $select = mysqli_query($conexao, $sql);
        $rs = mysqli_fetch_array($select);


        $tituloFilme=$rs['titulo_filme'];
        $resumoFilme=$rs["resumo_filme"];
        $imgPrimaria=$rs["img_primaria"];
        $descricaoOficial=$rs["descricao_oficial"];
        $informacaoComplementar = $rs["informacao_complementar"];
        $imgFundo = $rs["img_fundo"];
        $dtLancamento = $rs["dt_lancamento"];
        $nacionalidade = $rs["naciomanlidade"];
        $diretor = $rs["nome_diretor"];
   
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

    <?php include('header.php') ?>
    <section class="filme-do-mes center">
        <h1 class="titulo-melhor-filme" style="text-align:center;"> <?php echo $tituloFilme ?> </h1>
        <div class="linha1-filme-mes">

            <figure class="figura1-filme">
                <img src="cms/<?php echo $imgPrimaria ?>" alt="Imagem como treinar seu dragão 3" title="Como Treinar Seu Dragão 3" class="foto-filme-1" id="d">
            </figure>

            <div class="caracteristicas-filme">
                
                
                <div class="info-filme" id="texto">
                   
                    <span class="cinza-info">Data de lançamento</span> <?php echo $dtLancamento ?><br>
                    <span class="cinza-info">Direção:</span> <?php echo $diretor ?><br>
                    <span class="cinza-info">Nascionalidade</span> <?php echo $nacionalidade ?>
                </div>
                <div class="info-mais-filme">
                <p class="sinopse" > <?php echo $resumoDoFilme ?></p>
                </div>
            </div>
        </div>
        
        <div class="linha2-filme-mes">

            <div class="conclusao-filme">
                
               <h2 style="padding-left:30px; padding-bottom:20px;"> Descrição Oficial</h2>

                <p><?php echo $descricaoOficial ?></p>
            </div>
            <!-- /* aqui colocar a imagem no fundo para dar senssação de que ela esta fixa */ -->
            <figure class="figura2-filme" style="background-image: url(cms/<?php echo ($imgFundo) ?>);">
            
            </figure>
            <div class="historia-filme">
                 <p> <?php echo $informacaoComplementar ?>   </p>
            </div>
        </div>

    
   </section>
    <?php include('rodape.html') ?>
</body>
</html>