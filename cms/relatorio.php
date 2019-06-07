
<?php 

	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			Relatório
		</title>
		<script src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jscharting.js"></script>
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
							defaultPoint: {opacity: 1},
							type: "column",							
							tooltip:{
								
							},
							points: [
								<?php
									require_once('../bd/bd.php');
									$conexao = conexaoMysql("bd_locadora_w");
								
									$sql = "SELECT 
												*
											FROM
												tbl_filme
											ORDER BY click DESC LIMIT 10 ;";
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
	</head>
	<body style=" background-color: rgba(55,55,55, 1);">
		<div id="chartDiv" style="width: 800px; height: auto; margin-left: auto; margin-right: auto; margin-top: 90px; border-radius: 5px; background-color: aliceblue; padding: 5px;"></div>
	</body >
</html>