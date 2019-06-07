
<?php 
     require_once('../bd/bd.php');
     $conexao = conexaoMysql("bd_locadora_w");
    if(isset($_GET["deletar"])){

        $codigo = $_GET["deletar"];
        $sql = "DELETE FROM tbl_contato WHERE id=".$codigo;
            mysqli_query($conexao, $sql);
        
        // fazer o tratamento para ver se vai dar para excluir excluir, sim ou nao.
    }
     

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="../js/jquery.js"></script>
    <title>contato</title>
    <script>
        // abaixo foi usado uma biblioteca do jquery para dar um efeito e criar a modal onde vai aparecer masi info
        $(document).ready(function() {
            $('.lupa').click(function(){
                $('#container').slideDown(1000);
            });
        });

            // a função abaixo é estartada quando cliacado no botao mais info, trazendo o id do jogo
        function visualizarDados(idItem){

            // ajax permite executar outro arquivo e inserir seu resultado dentro do modal
            $.ajax({
                type:"GET",
                url:"modal.php",
                data: {codigo:idItem},
                success: function(dados){
                    console.log(dados);
                    $("#modal").html(dados);
                    

                }


            });
            
        };
        
    </script>
</head>
<body>
    <div id="container">
        <div id="modal">

        </div>
    </div>
    <?php include('header.php') ?>
    <section class="conteudo-tabelas-adm center">
        <h3 class="tirulo-mensagens"> Mensagens recebidas </h2>
        

            <div class="contatos center">
                <div class="titulo-contatos">Nome</div>
                <div class="titulo-contatos" style="border-left: solid 1px black;">E-mail</div>
                <div class="titulo-contatos" style="border-left: solid 1px black;width: 10%;">Ops</div>
                <?php 


                $sql= "SELECT *  from tbl_contato;";
                $select = mysqli_query($conexao, $sql);

                // enquanto o rsJogos receber uma lista (array) 
                while($rsContato = mysqli_fetch_array($select)){

                

                ?>
                    <div class="resultados-do-banco">

                        <div class="info-contato">
                            <?php echo($rsContato['nome']); ?>
                        </div>
                        <div class="info-contato">
                            <?php echo($rsContato['email'])   ?>
                        </div>
                        
                        <div class="ops-contato">
                            <a href="contato.php?deletar=<?php echo($rsContato['id']) ?>" onclick="return confirm('Confirmar exclusão de registro?')"> <img src="img/delete.png" alt=""></a> 
                           <img src="img/ver.png" alt="" class="lupa"  onclick="visualizarDados(<?php echo($rsContato['id']) ?>);">
                           
                        </div>
                    </div>    
                <?php
                    }
                ?>
            </div>

    </section>
    <?php include('footer.php') ?>  
</body>
</html>