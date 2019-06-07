
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/fale-conos.css">
    <title>Fale conosco</title>
</head>
<body class="body-contato">

    <?php include("header.php") ?>
    <section class="fale-conosco center">
        <div class="caixa-de-contato center">
            <div class="foto-info"><img src="img/icone-email.png" alt="Email"></div>
            <div class="titulo-caixa"><h1>E-MAIL</h1></div>
            <div class="texto-info-contato x">
                    Utiize este canal de contato para conseguir detalhar sua dúvida. 
                    No atendimento por e-mail não poderão ser tratados problemas 
                    realacionados a pagamento e nem efetuar a confirmação de seus
                    dados cadastrais.


            </div>
            <div class="link-contato"><h3>ENTRAR EM CONTATO POR E-MAIL </h3></div>
        </div>
    
        <div class="caixa-de-contato center">
            <div class="foto-info"><img src="img/telefone.png" alt=""></div>
            <div class="titulo-caixa">
                <h1>TELEFONES</h1>
            </div>
            <div class="texto-info-contato">
                <div class="linha-tel"> 
                    <div class="linhas-tel">
                        Grande São Paulo <br>
                        (11) 3065-7200
                    </div>
                    <div class="linhas-tel">
                            Televendas <br>
                            (11) 4003-3390
                    </div>
                </div>
                <div class="linha-tel"> 
                    <div class="linhas-tel">
                        Grande São Paulo <br>
                        (11) 3065-7200
                    </div>
                    <div class="linhas-tel">
                            Televendas <br>
                            (11) 4003-3390
                    </div>
                </div>
                <div class="linha-tel"> 
                    <div class="linhas-tel">
                        Grande São Paulo <br>
                        (11) 3065-7200
                    </div>
                    <div class="linhas-tel">
                            Televendas <br>
                            (11) 4003-3390
                    </div>
                </div>
                    
            </div>
        </div>
    
        <div class="caixa-contato-input center">
                <div class="foto-info"><img src="img/enviar-mensagem.png" alt=""></div>
                <div class="titulo-caixa-input"><H1>CHAT</H1></div>
                
                <form action="fale-conosco.php" method="get" >
                    <div class="caixa-mensagem-input">
                        <div class="linhas-input"><label>Nome:</label><br><input type="text" class="input-contato" placeholder="Digite seu Nome..." name="nome"></div>
                        <div class="linhas-input"><label>Telefone:</label><br><input type="tel" class="input-contato" placeholder="Digite Seu Telefone..." name="telefone"></div>
                        <div class="linhas-input"><label>E-mail:</label><br><input type="email"  class="input-contato" placeholder="Digite seu E-mail para contato..." name="email"></div>
                        <div class="linhas-input"><label>Celular:</label><br><input type="tel" class="input-contato" placeholder="Digite seu Celular..." name="celular"></div>
                        <div class="linhas-input"><label>Home Page:</label><br><input type="text" class="input-contato" placeholder="Home page..." name="home-page"></div>
                        <div class="linhas-input"><label>Link Facebook:</label><br><input type="url" class="input-contato" placeholder="Digite seu link do facebook..." name="facebook"></div>
                        <div class="linhas-input"><label>Profissão:</label><br><input type="text"  class="input-contato" placeholder="Profissão..." name="profissao"></div>
                        <div class="linhas-input"><label>Sexo:</label><br><select class="input-contato" name="sexo" id="slc-sexo"> <option value="V">Selecione Seu Sexo</option> <option value="M">Masculino</option><option value="F">Feminino</option></select></div>
                        <div class="linhas-input-grande"><label>Sugestões/Críticas:</label><br><textarea cols="80" rows="6 " class="textaera-input" placeholder="Digite Sugestões/Cíticas..." name="sugestoes"></textarea>  </div>
                        <div class="linhas-input-grande"><label>Informações de Produtos:</label><br><textarea cols="80" rows="6 " class="textaera-input" placeholder="Digite sua pergunta ou questionamento sobre algum produto..." name="perguntas"></textarea></div>
                        <div class="linha-btn">
                            <input type="submit" value="Enviar" class="btn-input">  
                        </div>
                    </div>
                </form>
        </div>
            
    
    </section>  
    <?php include("rodape.html") ?>  
</body>
</html>


