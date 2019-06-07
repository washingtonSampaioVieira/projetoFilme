<header>
    <div id="div_foto_menu"><img src="img/menu.png" class="img-menu" alt="logo" title="logo">

    </div>
    <div id="container_menu">
       <a href="index.php"> <img src="img/logo.png" class="logo-mobile" alt="logo" title="logo"></a>
        <div class="nome_empresa"> Acme Tunes</div>
    </div>  
    <nav id="menu-mobile">
            <ul id="menu-ul">
                <li class="menu_itens">
                    <a href="promocao.php">Promoções </a>
                </li>

                <li class="menu_itens">
                    <a href="atorDoMes.php">Ator do Mês</a>
                </li>

                <li class="menu_itens">
                    <a href="filmeDoMes.php" class="a">Filme do Mês</a>
                </li>

                <li class="menu_itens_2" id="li-nos">
                    Acme Tunes
                    <ul class="ul-interna">
                        <li class="menu_itens">
                            <a href="quemSomos.php">Quem somos</a>
                        </li>
                        <li class="menu_itens">
                            <a href="nossasLojas.php">Nossas lojas</a>
                        </li>
                        <li class="menu_itens">
                            <a href="fale-conosco.php">Fale conosco</a>
                        </li>

                    </ul>

                </li>
            </ul>
        </nav>



    <div id="menu-grande">
            <div id="cabecalho" class="center">
                <figure id="logo">
                    <a href="index.php"><img src="img/logo-menor.png" alt="Logo" title="logo" ></a>
                </figure>

                <nav id="menu">
                    <ul class="tabela-menu"> 
                        <li class="menu_itens">
                            <a href="promocao.php">Promoções </a>
                        </li>

                        <li class="menu_itens">
                            <a href="atorDoMes.php">Ator do Mês</a>
                        </li>

                        <li class="menu_itens">
                            <a href="filmeDoMes.php" class="a">Filme do Mês</a>
                        </li>

                        <li class="menu_itens" id="li-nos">
                            Acme Tunes
                            <ul class="ul-interna">
                                <li class="menu_itens">
                                    <a href="quemSomos.php">Quem somos</a>
                                </li>
                                <li class="menu_itens">
                                    <a href="nossasLojas.php">Nossas lojas</a>
                                </li>
                                <li class="menu_itens">
                                    <a href="fale-conosco.php">Fale conosco</a>
                                </li>

                            </ul>

                        </li>
                        
                    </ul>
                </nav>
                <div id="login">
                    <div class="label-usuario-l1">
                        <label class="label">Usuario</label><label>Senha</label>
                    </div>
                    <div class="label-usuario-l2">
                        <form action="login-users.php" method="post">
                            <input type="text" name="usuario" class="text" id="txt_login" >
                            <input type="password" name="senha" class="text" id="txt_senha">
                            <input type="submit" value="Entrar" name="login" class="btn" >
                        </form>

                    </div>
                </div>
            </div>
    </div>
            <script src="js/validar-login.js"></script>
</header>
<div class="tampar-buraco">

</div>
        
        
        <script src="js/jquery.js"></script>
        <script src="js/menu.js"></script>

