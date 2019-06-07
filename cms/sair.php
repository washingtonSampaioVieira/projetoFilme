<?php 

    session_start();
    session_unset($_SESSION);
    $_SESSION['logado']=false;
    echo ("<script>window.location.href='../home.php';</script>");
    

?>