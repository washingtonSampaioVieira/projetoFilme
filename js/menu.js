$(document).ready(function(){

    let menu = document.querySelector("#div_foto_menu");
    if(getComputedStyle(menu, null).display == "block"){
        
        $("#div_foto_menu").click(function(){
            // ação de mostrar o meno quando clicado
            $("#menu-mobile").slideToggle(1000);
        });

        // ação de fechar o menu no click so item
        $(".menu_itens").click(function () { 
            $("#menu-mobile").slideToggle(1000);
        });

        $(".menu_itens_2").click(function () {
            $(".ul-interna").slideToggle(1000);
        });
    };


    $(".item_suni_menu").click(function(){
        var menu = $(this).attr("data-menu");
        // ação de mostrar o meno quando clicado
        $(".sub"+menu).slideToggle(1000);
    });
    
});

