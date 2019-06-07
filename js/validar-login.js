

txtSenha = document.getElementById("txt_senha");
txtLogin = document.getElementById("txt_login");

function mascCaracterEspecial(txt){
    txt = txt.replace(/[^0-9A-z_.()]/g,"");
    return txt;
}
txtSenha.addEventListener("keyup",function(){ txtSenha.value= mascCaracterEspecial(txtSenha.value)});
txtLogin.addEventListener("keyup", function(){txtLogin.value = mascCaracterEspecial(txtLogin.value)});
