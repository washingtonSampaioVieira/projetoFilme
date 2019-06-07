<?php 
    require_once('funcoesphp/funcoesPadrao.php');
    $conexao = conexaoMysqlFunction("bd_locadora_w");

    if(isset($_POST['cod'])){
        $cod = $_POST['cod'];
        $sql = "SELECT * FROM tbl_cidade WHERE cod_estado = $cod";
        $op="";
        $nome ="";
      
        $select = mysqli_query($conexao, $sql);
        while($rs =  mysqli_fetch_array($select)){
            $value = $rs['cod_cidade'];
            $nome = $rs['nome_cidade'];
            echo "<option value='$value'>$nome</option>";
        }
        
           
    }
?>