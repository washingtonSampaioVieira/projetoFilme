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
        estado.cigla
    FROM
    tbl_loja AS loja
            INNER JOIN
        tbl_endereco AS endereco ON endereco.cod_endereco = loja.cod_endereco
            INNER JOIN
        tbl_cidade AS cidade ON cidade.cod_cidade = endereco.cod_cidade
            INNER JOIN
        tbl_estado AS estado ON estado.cod_estado = cidade.cod_estado  where loja.cod_loja=".$idLoja." and loja.ativa=1;";
        $select = mysqli_query($conexao, $sql);
        $rs = mysqli_fetch_array($select);


        $tituloLoja=$rs['titulo_loja'];
        $textoLoja=$rs["texto_loja"];
        $fotoLoja=$rs["foto_loja"];
        $enderecoCompletoLoja=$rs["nome_rua"].$rs['numero'].$rs["nome_cidade"].$rs["nome_estado"];

        
    
 
   
  

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/nossas-lojas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body style="background-color: rgb(226, 224, 224);">
    
    
    <?php include("header.php") ?>

    

    <section class="nossas-lojas center">
        <div class="localizacao">
        <iframe  id="xpto" style="border:0" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo($enderecoCompletoLoja); ?>&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" ></iframe>
        </div>

        <div class="especificacoes-da-loja">
        <?php
            $sql = "SELECT * FROM tbl_loja as loja where loja.ativa=1";
            $select = mysqli_query($conexao, $sql);
            while($rs =  mysqli_fetch_array($select)){

        ?>

            <div class="info-loja" style="
                 <?php 
                    if(isset($_GET['local'])){
                        if($_GET['local']==$rs['cod_loja']){
                            echo($stilo);

                        }else{
                            echo(' ');
                        }
                    }
                ?>
            ">
               <a href="nossasLojas.php?local=<?php echo($rs['cod_loja']);?>" >
                    <?php echo($rs["titulo_loja"]); ?>
               </a>
            </div>
        <?php
                }
        ?>

        </div>
    </section>


    <section class="info-lojas-sec"  style="display:<?php echo($senaiJandiraS) ?>">
        <div class="sobre-a-loja center">
            <h2 class="titulo-loja">Loja  <?php echo  $tituloLoja ?></h2>
            <div class="lojas-col1">
                <h3 class="sub-titulo-lojas">  <?php echo   $tituloLoja ?></h3>
                <?php echo $textoLoja ?>

                
               
            </div>
            <div class="lojas-col2">
                <img src="cms/<?php echo $fotoLoja ?>" alt="Loja da Acme Tunes localizada no Senai de Jandira" title="Loja da Acme Tunes localizada no Senai de Jandira" class="imagem_loja">
            </div>
        </div>
    </section>

    <!-- <section class="info-lojas-sec" style="display:< ?php echo($senaiBarueriS) ?>">
         <div class="sobre-a-loja center">
            <h2 class="titulo-loja">Loja no Senai de Barueri</h2>
            <div class="lojas-col1">
                <h3 class="sub-titulo-lojas">Sobre a loja</h3>
                <p> A segunda filial foi fundada em 2002, na cidade de Barueri, com
                o objetivo de atuar no segmento de alugueis de filmes online e presenciala tendendo, 
                principalmente, o ramo de entreteinimento domiciliar só que agora o foco era o aluguel físico.</p><br>

                <p> Em 2002,a empresa cresceu e se expecializou em filmes de ação tranzendo maiores novidades para a loja,
                uma das maiores fornecedoras da marca de tintas Suvinil,
                na Zona da Mata mineira.</p><br>

                <p> Com o passar do tempo, a gama de produtos aumentou e a diversidade de segmentos
                atendidos também. Com vista a atender as mais diversificadas esferas profissionais, 
                o portfólio de produtos vem aumentando consideravelmente.</p>

               
            </div>
            <div class="lojas-col2">
                <img src="img/lojaSenaiBarueri.jpg" alt="Loja da Acme Tunes localizada no Senai de Barueri" title="Loja da Acme Tunes localizada npo Senai de Barueri ">
            </div>
        </div>
    </section>
    <section class="info-lojas-sec" style="display:< ?php echo($paulistaS) ?>">
        <div class="sobre-a-loja center">
            <h2 class="titulo-loja">Loja na Paulista</h2>
            <div class="lojas-col1">
                <h3 class="sub-titulo-lojas">Sobre a Loja</h3>
                <p> A loja Paulista foi fundada em 2007, na cidade de São Paulo na avenida Paulista, com
                o objetivo de atuar ganhar maior reconhecimento no mercado, sendo a maior loja ja aberta pela 
                Acme e um sonho realizaso pelo seu fundador Washington que hoje está aposentado.</p><br>

                <p> Em 2009, a empresa fez diversas parcerias com cinemas, fazendo que a loja cumprisse seu papel no mercado
                    trazendo reconhecimento a empresa. Tais parcerias alavancaram ainda mais a empresa, fazendo que houvesse 
                    um crecimento por cerca de 30% dentre os anos de 2009 e 2012, tal feito revolucinou a Acme Tunes!!!</p>               
            </div>
            <div class="lojas-col2">
                <img src="img/lojaPaulista.jpg" alt="Loja da Acme Tunes localizada na Paulista" title="Loja da Acme Tunes localizada na Paulista ">
            </div>
        </div>
    </section>
    <section class="info-lojas-sec"  style="display:< ?php echo($villaLobosS) ?>">
        <div class="sobre-a-loja center">
            <h2 class="titulo-loja">Loja no Villa Lobos</h2>
            <div class="lojas-col1">
                <h3 class="sub-titulo-lojas">Sobre a loja</h3>
                <p> A loja no Villa Lobos fundada em 2014, na cidade de São Paulo, com o objetivo de trazer mais
                    lucrabilidade para a empresa.</p><br>

                <p> Em 2015 a loja bateu o recorede de vendas até mesmo de outras empresas da area, 
                    e tambem superando até mesmo as outras filiais que existian até então.
                </p><br>

                <p> Com o passar do tempo a loja ficou voltada para a area de vendas de filmes presencial, 
                    não tendo muita lucrabilidade no ramo de locação a filial se expecializou na area de vendas, superando 
                    as vendas de todas as outras lojas.  
                </p>

               
            </div>
            <div class="lojas-col2">
                <img src="img/lojaVilla.jpg" alt="Loja da Acme Tunes localizada no Villa Lobos" title="Loja da Acme Tunes localizada no Villa Lobos">
            </div>
        </div>
    </section>
    <section class="info-lojas-sec" style="display:< ?php echo($maspS) ?>">
        <div class="sobre-a-loja center">
            <h2 class="titulo-loja">Loja no Masp</h2>
            <div class="lojas-col1">
                <h3 class="sub-titulo-lojas">Sobre a loja</h3>
                

               
                <p> A loja no Masp foi fundada no ano de 2016, na cidade de São paulo, com o objetico de trazer mais lazer 
                     e cultura ao moradores que visitam o Museu de SP e logo após a visita 
                        podem passar pela Acme para alugar um documentario ou até mesmo um filme para assistir na noite em familia.</p><br>

                <p> Em 2017 a loja do Masp tenha se tornado maior cerca de 60% de quando foi fundada.
                    Ganhando muitos clientes na cidade de SP, a Loja possibilitou o GRANDE aumento de vendas e 
                    aluguel de filmes online, mudando o caminho da história Acme novamente. 
                </p><br>

                <p> Com o passar do tempo a loja foi abrindo muitas portas de emprego para apopulaçao da região de SP,
                    prinipalmente na area de desenvolvimento de softwrem pois foi preciso de uma grande equipe para fazer 
                    e integrar todos os sitemas da empresa Acme.</p>



            </div>
            <div class="lojas-col2">
                <img src="img/lojaMasp.jpg" alt="Loja da Acme Tunes localizada no Masp" title="Loja da Acme Tunes localizada no Masp">
            </div>
        </div>
    </section> -->
    

    <?php include("rodape.html") ?>
</body>
</html>