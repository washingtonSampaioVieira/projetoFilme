<?php

    require_once('../bd/bd.php');
    $conexao = conexaoMysql("bd_locadora_w");

    if(isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        $sql= "SELECT *  from tbl_contato where id=".$codigo;
        $select = mysqli_query($conexao, $sql);
        $contato = mysqli_fetch_array($select);
    }
    
    






?>



<script>
    $(document).ready(function(){
        $("#container").click(function(){
                $("#container").fadeOut(400);
        });
    });
</script>
<div class="linha-explicacao">
    Contato de numero <?php echo $contato["id"]." - ".  $contato['nome'] ?>
</div>
<div class="l1col3">
    <div class="titulo-tipo">Código</div>
    <?php echo($contato['id']) ?> 
</div>
<div class="l1col3">
<div class="titulo-tipo">Nome</div>
    <?php echo($contato['nome']) ?> 
</div>
<div class="l1col3">
<div class="titulo-tipo">Telefone</div>
    <?php echo($contato['telefone']) ?>  
</div>
<div class="l1col3">
<div class="titulo-tipo">Home Page</div>
<?php echo($contato['home_page']) ?>
</div>
<div class="l1col3">
<div class="titulo-tipo">Sexo</div>
<?php echo( $contato['sexo'] =="M" ?  "Masculino": "Feminino") ?>
</div>

<div class="l1col3">
<div class="titulo-tipo">Profissão</div>
<?php echo($contato['profissao']) ?>
</div>


<div class="l1col1">
<div class="titulo-tipo"> SUGESTOES / CRITICAS</div>
<?php echo($contato['sugestoes_criticas']) ?>
</div>
<div class="l1col1">
<div class="titulo-tipo">Perguntas</div>
<?php echo($contato['perguntas']) ?>
</div>

<div class="l1col1">
<div class="titulo-tipo"> LINK FACEBOOK</div>
<?php echo($contato['link_facebook']) ?>
</div>  


<div class="l1col2">
<div class="titulo-tipo">E-MAIL</div>
<?php echo($contato['email']) ?>
</div>
<div class="l1col2">
<div class="titulo-tipo">Celular</div>
<?php echo($contato['celular']) ?>
</div>


