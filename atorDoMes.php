<?php 

    require_once('bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");

    $sql ='select * from tbl_ator_do_mes where ativo=1;';

    $select = mysqli_query($conexao, $sql);
    $rsConteudo = mysqli_fetch_array($select);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ator do Mês</title>
</head>
<body>
    <?php include("header.php") ?>
    <section class="ator-do-mes center">
        <h1 class="center">Ator Do Mês</h1>
        <div class="linha1-ator">
            <figure class="foto-ator"><img src="cms/<?php echo $rsConteudo['img_primaria'] ?>" class="foto-ator-1" alt="Joseph Jason"></figure>
            <div class="texto-nome-ator">   
                <div class="nome-ator"><h2><?php echo $rsConteudo["titulo_nome_ator"] ?></h2></div>
                <div class="texto-ator">
                    <?php echo $rsConteudo["historia_ator"] ?>
                </div>
            </div>
        </div>
    
    
        <div class="linha2-ator">
            <figure class="foto-meio-ator center">
                <img src="cms/<?php echo $rsConteudo['img_personagem'] ?>" class="foto-filme-2" alt="img ator do mes">
            </figure>
        </div>
    
    
        <div class="linha3-ator">
            <div class="biografia-ator">
                <?php echo $rsConteudo["biografia_ator"] ?>   
            </div>
        </div>
    
    </section>
    <?php include("rodape.html") ?>
</body>
</html>