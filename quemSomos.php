<?php 

    require_once('bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");

    $sql ='select * from tbl_quem_somos where ativo=1;';

    $select = mysqli_query($conexao, $sql);
    $rsConteudo = mysqli_fetch_array($select);

?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Sobre</title>
</head>
<body>

    <?php include('header.php') ?>
    
    <section class="quem-somos center">

    
        <div id="quem-somos">
            <h1>Quem Somos</h1>
            <p><?php echo $rsConteudo['foco_da_empresa'] ?></p> 

            <p><?php echo $rsConteudo['intro_historia'] ?></p>
        </div>

        <div id="logo-quem-somos">
            <figure class="figura-logo" id="i" style="">
                <img src="cms/<?php echo $rsConteudo['nome_img'] ?>" alt="Logo da empresa" title="Logo Acci Tunes" class="u" >
                
            </figure>

        </div> 
        <div class="quem-somos-historia">
            <?php echo $rsConteudo['texto_historia_empresa'] ?>
        </div>
    </section>
    <?php include('rodape.html') ?>
</body>
</html>