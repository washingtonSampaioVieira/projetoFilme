<?php
    require_once('../bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");
    $sql = "SELECT 
                *
            FROM
                tbl_filme
            ORDER BY click DESC LIMIT 10 ;";
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>
        Relatório
    </title>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jscharting.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script>
        $(document).ready(function(){
            const chart = new JSC.Chart("chartDiv", {
                xAxis_scale_type: "Qualitative",
                yAxis_label_text: "Produtos Mais Visitados",
                defaultPoint_label_text: "%yValue",
                defaultSeries_palette: "default",
                annotations: [
                    {
                        position: "top",
                        label_text: "RELATÓRIO DE PRODUTOS MAIS VISITADOS"
                    }
                ],
                height: 450,
                defaultSeriesType: 'column',
                title: { 
                    label: { 
                        text: "Relatório de Produtos"
                    }
                },
                series: [
                    {
                        name: 'Produtos',
                        defaultPoint: {opacity: 0.9},
                        type: "column",							
                        tooltip:{
                            
                        },
                        points: [
                            <?php
                                $select = mysqli_query($conexao, $sql);
                                while($filme = mysqli_fetch_array($select)){
                            ?>
                                
                            {name:'<?php echo($filme["titulo_filme"]) ?>', y:<?php echo($filme["click"]) ?>, tooltip: "<b>%name</b><br> <b>Acesso:</b> %yValue <br> <b>Percentual:</b> %percentOfSeries%"},
                            <?php 
                                }
                            ?>
                        ]
                    }
                ]
            });
            $("#brandingLogo").css("display", "none");
        });
    </script>
    <body id="body-adm">
        <?php include('header.php') ?> 
        <div class="conteudo-tabelas-adm center">
            <div id="chartDiv" style="width: 800px; height: auto; margin-left: auto; margin-right: auto; margin-top: 40px; margin-bottom: 20px; border-radius: 5px; background-color: rgb(121, 121, 121); padding: 5px;"></div>
        </div>
        
        <?php include('footer.php') ?>  
    </body>
</html>