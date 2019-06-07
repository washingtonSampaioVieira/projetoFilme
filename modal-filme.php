
<?php
    require_once('bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");
    $cod = $_GET["id"];
    $sql="select * from tbl_filme where cod_filme =$cod  ";
    $select = mysqli_query($conexao,$sql);
    $filme = mysqli_fetch_array($select);
    $cod= $filme["cod_filme"];
    $click= $filme["click"]+1;

    $sqlInsert = "update tbl_filme set click = $click where cod_filme = $cod;";
    mysqli_query($conexao,$sqlInsert);
?>
<link rel="stylesheet" href="css/style.css">



<div class="caixa-modal center">
    <table border=0 id="tabela_filme">
        <tr>
            
            <td class="td_conteudo" colspan=2 style="text-align: center;"><h1><?php echo($filme["titulo_filme"]) ?></h1></td>
        </tr>
        <tr>
            <td class="td_titulo">Descricao: </td>
            <td class="td_conteudo"><?php echo($filme["resumo_filme"]) ?></td>
        </tr>
        <tr>
            <td class="td_titulo">Preço: </td>
            <td class="td_conteudo"><?php echo($filme["preco_filme"]) ?></td>    
        </tr>
        <tr>
            <td class="td_titulo">Nacionalidade: </td>
            <td class="td_conteudo"><?php echo($filme["naciomanlidade"]) ?></td>
        </tr>
        <tr>
            <td class="td_titulo">Informação complementar: </td>
            <td class="td_conteudo"><?php echo($filme["informacao_complementar"]) ?></td>
        </tr>
        <tr>
            <td class="td_titulo">Data de lançamento: </td>
            <td class="td_conteudo"><?php echo($filme["dt_lancamento"]) ?></td>
        </tr>
    </table>
    <figure class="center figure_foto_filme">
        <img src="cms/<?php echo($filme["img_primaria"]) ?>" class="img_foto_filme_modal" alt="">
    </figure>
</div>
