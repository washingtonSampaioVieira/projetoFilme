

<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    function conexaoMysqlFunction($database){
        // mysql_connect() - bibloteca de coneção com o banco msql - vigente ate php 5.3
        // mysqlli()- bibloteca de coneção com o banco msql - vigente ate as versoes atuais
        // PDO() - bibloteca de coneção com o banco msql mais ultilizada em projetos orientado a objetos


        // variaveis pora passar argumentos
        // $conexao = null;
        // $server = "localhost";
        // $user = "root";
        // $password = "bcd127";
        // $database="bd_locadora_w";

        $conexao = null;
        $server = "192.168.0.2";
        $user = "pc1820191";
        $password = "senai127";
        $database="dbpc1820191";


        // variavel que vai ter a conexao com o banco
        $conexao = mysqli_connect($server, $user,$password,$database);
        return $conexao;
    }   


    function apagarRegistro($id, $banco, $pg){
        $conexao = conexaoMysqlFunction("bd_locadora_w");
        $codigo =  ($id);
        
            $sqlCod ='select * from '.$banco.' where cod='.$codigo.';';
            $selectCod = mysqli_query($conexao, $sqlCod);  
            echo $sqlCod;
            
            $rsCod = mysqli_fetch_array($selectCod);
            if($rsCod['cod'] == $codigo && $rsCod['ativo'] == 0){
                if(is_int($codigo)){
                    $slqDel = "DELETE FROM  ".  $banco." WHERE cod=".$codigo;                
                    mysqli_query($conexao, $slqDel);
                    echo("<script>window.location.href='".$pg."';</script>");    
                    return true;       
                }
            }else{
                echo ("<script>alert('REGISTRO NAO EXCLUIDO, NAO PERMITIDO EXCLUIR REGISTRO ATIVO OU REGISTRO INESISTENTE.');window.location.href='".$pg."';</script>");            
                return false;
            }

    }

    function salvarRegistro($pg, $sql){
        $conexao = conexaoMysqlFunction("bd_locadora_w");
        mysqli_query($conexao, $sql);
        echo ("<script>window.location.href=".$pg.";</script>");
    }
    


    function apagarRegistroCampo($id, $banco, $pg, $campo){
        //echo $id;
        $conexao = conexaoMysqlFunction("bd_locadora_w");
        $codigo =  $id*1;
        
            $sqlCod ='select '.$campo.' as cod from '.$banco.' where '.$campo.'='.$codigo.';';
            //echo $sqlCod;

            $selectCod = mysqli_query($conexao, $sqlCod);  
            $rsCod = mysqli_fetch_array($selectCod);
            
            if($rsCod['cod'] == $codigo){

                if(is_int($codigo)){
                    $slqDel = "DELETE FROM  ".  $banco." WHERE $campo=".$codigo;     
                    mysqli_query($conexao, $slqDel); 
                    //echo("<script>window.location.href='".$pg."';</script>");    
                    return true;       
                }else{
                    echo ("<script>alert('ERRO!);window.location.href='".$pg."';</script>");            
                }
            }else{

                
                echo ("<script>alert('REGISTRO NAO EXCLUIDO, NAO PERMITIDO EXCLUIR REGISTRO ATIVO OU REGISTRO INESISTENTE.');window.location.href='".$pg."';</script>");            
                return false;
            }

    }



    function ativarRegistro ($id,$banco, $pg){
        $conexao = conexaoMysqlFunction("bd_locadora_w");   
        $codigo = $id;
        $sqlValidacao = "SELECT count(cod) as total FROM ".$banco." WHERE cod=".$codigo;
        $selectValiidacao = mysqli_query($conexao, $sqlValidacao);
        $rsLinhas = mysqli_fetch_array($selectValiidacao);
        if($rsLinhas["total"] == 1){
            $sql = "UPDATE ".$banco." SET ativo=0 WHERE cod>0;";
            mysqli_query($conexao, $sql);
            $ativar = "UPDATE ".$banco." SET ativo=1 WHERE cod=".$codigo;
            mysqli_query($conexao, $ativar);
            echo ("<script>window.location.href='".$pg."';</script>");
        }else{
            //echo ("<script>alert('REGISTOR INESISTENTE');window.location.href='".$pg."';</script>");
            
        }
    }
    function ativarOutroRegistro ($id,$banco, $pg, $campo){
        $conexao = conexaoMysqlFunction("bd_locadora_w");   
        $codigo = $id;
        $verificacao = "SELECT * FROM $banco WHERE $campo =".$id;
        $rs =  mysqli_fetch_array(mysqli_query($conexao, $verificacao));
        if($rs["ativa"] == 0){
            $ativar = "UPDATE ".$banco." SET ativa=1 WHERE $campo=".$codigo;
        }else{
            $ativar = "UPDATE ".$banco." SET ativa=0 WHERE $campo=".$codigo;
        }
        echo($ativar);
        if(mysqli_query($conexao, $ativar)){
            echo ("<script>window.location.href='".$pg."';</script>");
        }else{
            echo ("<script>alert('REGISTOR INESISTENTE');;</script>");
            
        }
    }
    function ativarOutroRegistroOutro ($id,$banco, $pg, $campo){
        $conexao = conexaoMysqlFunction("bd_locadora_w");   
        $codigo = $id;
        $verificacao = "SELECT * FROM $banco WHERE $campo =".$id;
        $rs =  mysqli_fetch_array(mysqli_query($conexao, $verificacao));
        if($rs["ativo"] == 0){
            $ativar = "UPDATE ".$banco." SET ativo=1 WHERE $campo=".$codigo;
        }else{
            $ativar = "UPDATE ".$banco." SET ativo=0 WHERE $campo=".$codigo;
        }
        echo($ativar);
        if(mysqli_query($conexao, $ativar)){
            echo ("<script>window.location.href='".$pg."';</script>");
        }else{
            echo ("<script>alert('REGISTOR INESISTENTE');;</script>");
            
        }
    }
    function ativarOutroRegistroAtivo ($id,$banco, $pg, $campo){
            $conexao = conexaoMysqlFunction("bd_locadora_w");   
            $codigo = $id;
            $sqlValidacao = "SELECT count($campo) as total FROM ".$banco." WHERE $campo=".$codigo;
            $selectValiidacao = mysqli_query($conexao, $sqlValidacao);
            $rsLinhas = mysqli_fetch_array($selectValiidacao);
            if($rsLinhas["total"] == 1){
                $sql = "UPDATE ".$banco." SET ativo=0 WHERE $campo>0;";
                mysqli_query($conexao, $sql);
                $ativar = "UPDATE ".$banco." SET ativo=1 WHERE $campo=".$codigo;
                mysqli_query($conexao, $ativar);
                echo $sql;
                echo ("<script>window.location.href='".$pg."';</script>");
            }else{
                echo ("<script>alert('REGISTOR INESISTENTE');window.location.href='".$pg."';</script>");
                
            }
        }
    
    
     
    function uploadImg($arquivo, $arquivo_temp, $tamanho_arquivo){


        /* poderia ser uma constante os arquivos permitidos no upload e o diretorio que a imagem vai ser gravada.*/
        $arquivos_permitidos = array(".jpg", ".jpeg", ".png");
        $diretorio = "img/";

        
        // pegando o nome do aquivo e o tamnho do arquivo que vai ser upado para o servidor
        
        // convertendo o valor de bites em kbites
        $tamanho_arquivo = round($tamanho_arquivo/1240);
        // echo $tamanho_arquivo;

        //pega a extancao do arquivo strrch() => pega uma string e peha a partir do caracter "x".
        $extencao_arquivo = strrchr($arquivo,".");
        // echo $extencao_arquivo;

        // para pegar somente o nome do arquivo ultilizamos a biblioteca pathinfo(); 
        $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
        // echo $nome_arquivo;


        // gerar nome unico para cada imagem que for salva, uniqid() gera sequencia aleatoria de numero de hora, minuto e segundos;
        $arquivo_criptografado = md5(uniqid(time()).$nome_arquivo);
        // echo $arquivo_criptografado;
        // var_dump($_FILES["flefotos"]);



        if(in_array($extencao_arquivo, $arquivos_permitidos)){
            if($tamanho_arquivo <= 9000){
                // criamos o nome com a extenção do arquivo que sera enviado para o servidor
                $foto = $arquivo_criptografado.$extencao_arquivo;

                

                // função que move um arquivo para outro lugar, pedindo o arquivo horigem e o destino
                if(move_uploaded_file($arquivo_temp, $diretorio.$foto)){
                    return $diretorio.$foto;

                }else{
                    return false;
                }

            }else{
                return false;


            }
        }else{
            return false;
        }
    }

        
    function  apagarFoto($nome_foto){
        
        $teste = $nome_foto;
        // echo($teste);
        @unlink($teste);
    }

?>