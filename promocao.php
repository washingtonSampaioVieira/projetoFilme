
<?php 
    $tituloLoja="";
    $textoLoja="";
    $fotoLoja="";
    $enderecoCompletoLoja="";


    require_once('bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");

    $localizacao ="";
    // <iframe width="700" height="440" src="https://maps.google.com/mapswidth=700&amp;height=440&amp;hl=en&amp;q=06653430&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed"></iframe>
    $stilo= 'transform: scale(1.09);background-color: rgb(136, 255, 0);box-shadow: 3px 3px 5px black;';


    if(isset($_GET["local"])){
        
        $idLoja=$_GET["local"];
    }else{
        $sql = "select min(cod_loja) as cod from tbl_loja where ativa = 1";
        $rs =mysqli_fetch_array(mysqli_query($conexao,$sql));
        $idLoja = $rs['cod'];
    }
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
    <!-- <section class="center"id="img-promocao">
        <h1> Promoções</h1>
    
    </section> -->
    <!-- <section class="promocao-do-mes center">
        <h1 class="titulo-promocao center">
            Promoção do mês
        </h1>
        <p class="texto-promocao center">
            A promoção do mes de abriu vai paras os filmes de ação, que então entre os mais procurados e vendidos no nosso site.
            Aproveite a promoção e garanta o melhor filme online para assistir no fim de semana sem depender da velocidade de 
            sua internet ou qualquer outro fator externo, comprando o cd vc ainda levra de brinde na promoção o frete para toda SP.
        </p>
        
        <h3 class="alert">Atenção: </h3><p class="alet-promocao">Promoção valida até 10/03/2019 ou enquanto dure nossos estoques.</p>
    </section> -->
  
    <section class="conteudo center">
        <div class="propagandas">
            <a href="www.facebook.com"><div class="img-propaganda" id="facebook"></div></a>
            <a href="www.twitter.com"><div class="img-propaganda" id="twitter"></div></a>
            <a href="www.instagram.com"><div class="img-propaganda" id="instagram"></div></a>
        </div>
        <!-- <div id="conteudos">
            <div class="item_suni_menu menu1" data-menu="1">DVD
                <div class="menu_sub_item sub1">
                    <div class="sub">Terror</div>
                    <div class="sub">Comedia</div>
                    <div class="sub">Suspense</div>
                    <div class="sub">Documentário</div>
                    <div class="sub">Infantis</div>
                    <div class="sub">Romance</div>
                    <div class="sub">Adultos</div>
                    <div class="sub">Seriados</div>
                </div>
            </div>
            <div class="item_suni_menu menu2"  data-menu="2">VHS
                <div class="menu_sub_item sub2">
                    <div class="sub">Terrorssssss</div>
                    <div class="sub">Comedia</div>
                    <div class="sub">Suspense</div>       
                    <div class="sub">Seriados</div>
                </div> 
            </div>
            <div class="item_suni_menu" data-menu="3">BlueRay
                <div class="menu_sub_item sub3">
                    <div class="sub">Terrorssssss</div>
                    <div class="sub">Comedia</div>
                    <div class="sub">Suspense</div>       
                    <div class="sub">Seriados</div>
                </div> 
            </div>
            <div class="item_suni_menu" data-menu="4">Jogos
                <div class="menu_sub_item sub4">
                    <div class="sub">Terrorssssss</div>
                    <div class="sub">Comedia</div>
                    <div class="sub">Suspense</div>       
                    <div class="sub">Seriados</div>
                </div> 
            </div>
        </div> -->
    </div>  

        <div class="produtos">

        <?php
        $sql = "SELECT 
        promocao.ativo,
        filme.titulo_filme,
        filme.cod_filme,
        filme.preco_filme,
        promocao.desconto,
        filme.descricao_oficial,
            filme.img_primaria
            FROM
        tbl_promocao AS promocao
            INNER JOIN
        tbl_filme AS filme ON filme.cod_filme = promocao.cod_filme WHERE promocao.ativo=1;";

        
        $select= mysqli_query($conexao, $sql);

            while ($rs = mysqli_fetch_array($select)){

        

        $tituloFilme=$rs['titulo_filme'];
        $preco=intval($rs["preco_filme"]);
        $desconto=intval($rs["desconto"]);
        $descricaoOficail = $rs["descricao_oficial"];
        $img = $rs["img_primaria"];
        
        ?>
        
            <div class="conteudo-promocao">
                <figure class="img-promocao-1 center">
                    <img src="cms/<?php echo $img ?>" class="fotoFilme imagen_filha"  alt="imagem do filme na promoção" title="Filme em Promoção">
                </figure>
                <div class="obs-pro esconder-testo" ><?php echo $tituloFilme ?> </div>
                <div class="desconto esconder-testo">R$ <?php echo($preco - ($preco *$desconto/100)); ?> <br><span class="preco-antigo">R$ <?php echo $preco ?></span> 		</div>
                <a href="#"><div class="btn-comprar">Comprar </div></a><div class="core">&hearts;</div> 
            </div>

        <?php } ?>    


            <!-- <div class="conteudo-promocao">
                <figure class="img-promocao-1 center">
                    <img src="img/filme2.jpg" alt="imagem do filme na promoção" title="Filme em Promoção">
                </figure>
                <div class="obs-pro">Elium entre dois mundos a Marte<br> Ficção, Ação e comédia </div>
                <div class="desconto">R$ 109,99<br><span class="preco-antigo">R$ 159,99</span> 		</div>
                <a href="#"><div class="btn-comprar">Comprar </div></a><div class="core">&hearts;</div> 
            </div>
            <div class="conteudo-promocao">
                <figure class="img-promocao-1 center">
                    <img src="img/filme3.jpg" alt="imagem do filme na promoção" title="Filme em Promoção" >
                </figure>
                <div class="obs-pro">Elium entre dois mundos a Marte<br> Ficção, Ação e comédia </div>
                <div class="desconto">R$ 109,99<br><span class="preco-antigo">R$ 159,99</span> 		</div>
                <a href="#"><div class="btn-comprar">Comprar </div></a><div class="core">&hearts;</div> 
            </div>
            
            <div class="conteudo-promocao">
                <figure class="img-promocao-1 center">
                    <img src="img/filme2.jpg" alt="imagem do filme na promoção" title="Filme em Promoção">
                </figure>
                <div class="obs-pro">Elium entre dois mundos a Marte<br> Ficção, Ação e comédia </div>
                <div class="desconto">R$ 109,99<br><span class="preco-antigo">R$ 159,99</span> 		</div>
                <a href="#"><div class="btn-comprar">Comprar </div></a><div class="core">&hearts;</div> 
            </div>
            <div class="conteudo-promocao">
                <figure class="img-promocao-1 center">
                    <img src="img/filme3.jpg" alt="imagem do filme na promoção" title="Filme em Promoção">
                </figure>
                <div class="obs-pro">Elium entre dois mundos a Marte<br> Ficção, Ação e comédia </div>
                <div class="desconto">R$ 109,99<br><span class="preco-antigo">R$ 159,99</span> 		</div>
                <a href="#"><div class="btn-comprar">Comprar </div></a><div class="core">&hearts;</div> 
            </div> -->
            
            
        </div>

    </section>
    <?php include('rodape.html') ?>
</body>
</html>