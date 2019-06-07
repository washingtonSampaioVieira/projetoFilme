<?php
    $tituloLoja="";
    $textoLoja="";
    $fotoLoja="";
    $enderecoCompletoLoja="";


    require_once('bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");

    $localizacao ="";

    $sqlFilmes = "SELECT 
                *
                FROM
                tbl_filme
                ORDER BY RAND();";
    if(isset($_GET["busca_categoria"])){
        $categoria = $_GET["busca_categoria"];
        $sqlFilmes = "SELECT 
                       distinct(filme.cod_filme), filme.*
                        FROM
                        tbl_filme AS filme
                        INNER JOIN
                        tbl_categoria_sub_filme AS c ON c.cod_categoria = $categoria
                        AND c.cod_filme = filme.cod_filme;";

        if(isset($_GET["sub"])){
            $sub = $_GET["sub"];
            $sqlFilmes = "SELECT 
                            *
                            FROM
                            tbl_filme AS filme
                            INNER JOIN
                            tbl_categoria_sub_filme AS c ON c.cod_categoria = $categoria
                            AND c.cod_sub_categoria = $sub
                            AND c.cod_filme = filme.cod_filme;";
                            


            
        }
        
    }
    // <iframe width="700" height="440" src="https://maps.google.com/mapswidth=700&amp;height=440&amp;hl=en&amp;q=06653430&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed"></iframe>
    
    //     SELECT 
    //     filme.titulo_filme
    // FROM
    //     tbl_filme AS filme
    //         INNER JOIN
    //     tbl_categoria_sub_filme AS c ON c.cod_categoria = 1
    //         AND c.cod_sub_categoria = 1
    //         AND c.cod_filme = filme.cod_filme;
    
    // SELECT 
    //     *
    // FROM
    //     tbl_filme AS filme
    //         INNER JOIN
    //     tbl_categoria_sub_filme AS c ON c.cod_filme = filme.cod_filme
    //         INNER JOIN
    //     tbl_categoria AS categoria ON categoria.cod_categoria = c.cod_categoria
    //         INNER JOIN
    //     tbl_sub_categoria AS sub ON sub.cod_sub_categoria = c.cod_sub_categoria;
    
    // SELECT 
    //     *
    // FROM
    //     tbl_filme AS filme
    // WHERE
    //     filme.titulo_filme LIKE '%Te%';


    if(isset($_POST["caixa_de_busca"])){
        $busca = $_POST["txt_busca"];

        $sqlFilmes = "SELECT 
                            *
                        FROM
                            tbl_filme AS filme
                        WHERE
                            filme.titulo_filme LIKE '%$busca%'
                             or filme.resumo_filme LIKE '%$busca%';";
    }



?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/jquery.js"></script>
    <title>Document</title>
    <script>
        
        $(document).ready(function() {

            $(".btn-detalhes-home").click(function(){
                $("#modal_filme").fadeIn(100);
            });
            $("#modal_filme").click(function(){
                $("#modal_filme").fadeOut(100);
            });

        });
        function abrirModal(id){

            $.ajax({
            url: "modal-filme.php",
            type: "GET",
            data: {id},
            dataType: "html",
                success:function(dados) {
                    $("#modal_filme").html(dados);
                
                    console.log(dados);
                }
            })
        }

    </script>
</head>
<body>
        
    <div id="modal_filme"></div>
    <?php include('header.php') ?>

    <section id="slider" class="center">
            <?php include('slide.php') ?>
    </section>
    <div class="img_index">
            <img src="img/eu-sempre-voce.jpg" id="img_entrada" alt="">
        </div>

    <section class="conteudo center">
        <div class="propagandas">
            <a href="www.facebook.com"><div class="img-propaganda" id="facebook"></div></a>
            <a href="www.twitter.com"><div class="img-propaganda" id="twitter"></div></a>
            <a href="www.instagram.com"><div class="img-propaganda" id="instagram"></div></a>
        </div>
        <div id="conteudos">
        <form action="index.php" method="post">
            <input type="text" name="txt_busca"  id="input_de_busca"><input id="btn_de_busca" class="btn" type="submit" name="caixa_de_busca" value="Buscar">
        </form>
        <?php

            $sql = "SELECT 
            group_concat(distinct sub.cod_sub_categoria) as cod_sub, group_concat(distinct sub.nome_sub_categoria) as nome_sub, categoria.*
           FROM
                tbl_filme AS filme
                    INNER JOIN
                tbl_categoria_sub_filme AS c ON c.cod_filme = filme.cod_filme
                    INNER JOIN
                tbl_categoria AS categoria ON categoria.cod_categoria = c.cod_categoria
                    INNER JOIN
                tbl_sub_categoria AS sub ON sub.cod_sub_categoria = c.cod_sub_categoria group by categoria.cod_categoria;";
           
           $select = mysqli_query($conexao,$sql);
           $cont = 0;
            while($categoria= mysqli_fetch_array($select)){
                
                $codCategoria = $categoria["cod_categoria"];
                $codSub = explode(",", $categoria["cod_sub"]);
                $nomeSub = explode(",", $categoria["nome_sub"]);
                $cont++;
                
        ?>
                <div class="item_suni_menu menu<?php echo($cont)?>" data-menu="<?php echo($cont)?>"> <a href="index.php?busca_categoria=<?php echo $codCategoria ?>">
                    <?php echo($categoria["nome_categoria"]) ?></a>
                    <div class="menu_sub_item sub<?php echo($cont)?> center">
                    <?php
                       
                        for($i = 0; $i  < count($codSub); $i++){
                    ?>
                            <a href="index.php?busca_categoria=<?php echo ($codCategoria) ?>&sub=<?php echo $codSub[$i] ?>">
                                <div class="sub">
                                    <?php echo $nomeSub[$i] ?>
                                </div>
                            </a>
                            
                    <?php
                        }
                    ?>
                    </div>
                </div>

        <?php
            }
        ?>
            <!-- <div class="item_suni_menu menu2"  data-menu="2">VHS
                <div class="menu_sub_item sub2">
                    <div class="sub">Terrorssssss</div>
                    <div class="sub">Comedia</div>
                    <div class="sub">Suspense</div>       
                    <div class="sub">Seriados</div>
                </div> 
            </div> -->
            <!-- <div class="item_suni_menu" data-menu="3">BlueRay
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
            </div> -->
        </div>
    </div>    

        <div class="produtos">
            <?php
                

            
               $select= mysqli_query($conexao, $sqlFilmes);

                while ($rs = mysqli_fetch_array($select)){
                $tituloFilme=$rs['titulo_filme'];
                $preco=intval($rs["preco_filme"]);
                $descricaoOficail = $rs["descricao_oficial"];
                $img = $rs["img_primaria"];
                $cod = $rs["cod_filme"];
                
            ?>

            <div class="conteudo-site">
                <figure class="img-produto center">
                    <img src="cms/<?php echo($img); ?>" alt="Foto Filme" class="imagen_filha" title="Foto Filme">
                </figure>
                <div class="obs top_10">Nome: <?php echo($tituloFilme); ?></div>
                <div class="obs">Descrição: <?php echo($descricaoOficail); ?></div>
                <div class="obs">Preço: <?php echo($preco); ?></div>
                
                <div class="btn-detalhes-home" onclick="abrirModal(<?php echo($cod) ?>);">Detalhes</div>
            </div>
        <?php
            }
        ?>
        </div>

    </section>

    <?php  include('rodape.html')?>
    

    <script src="js/jssor.slider-27.5.0.min.js"></script>
   
</body>
</html>