let txtTelefone = document.getElementById('txtTelefone');
let txtNome= document.querySelector('#txtNome');
let txtCelular =document.querySelector('#txtCelular');
let txtProficao = document.querySelector('#txtProficao');
let email = document.getElementById("txtEmail");
let homePage = document.getElementById("txtHomePage");
let linkFacebook = document.getElementById("txtFacebook");
let sugestoes_criticas = document.getElementById("txtSugestoes");
let perguntas = document.getElementById("txtInformacoes");


function mascTelefon  ()  {
    
    let telefone = txtTelefone.value;
    telefone = telefone.replace(/[^0-9]/, "");

    telefone = telefone.replace(/(.{4})/,"$1-");

    txtTelefone.value = telefone;
}

function mascCelular () {
    let celular = txtCelular.value;
    celular = celular.replace(/[^0-9]/g, "");

    celular = celular.replace(/(.{2})/, "$1 ");
    // if(celular.lenf)
    celular = celular.replace(/(.{8})/, "$1-");
    
    txtCelular.value = celular;
}

function mascNome  () {
    let nome = txtNome.value;

    nome = nome.replace(/[^A-Z\. A-z]/,"");
    nome = nome.toUpperCase();

    txtNome.value = nome;
}
function mascProficao (){
    let proficao = txtProficao.value;

    proficao = proficao.replace(/[^A-Z\. A-z]/,"");
    proficao = proficao.toUpperCase();

    txtProficao.value = proficao;
}
function mascCaracterEspecial(txt){
    txt = txt.replace(/[^0-9A-z_.()]/g,"");
    return txt;
}








homePage.addEventListener("keyup",function(){ homePage.value= mascCaracterEspecial(homePage.value)});
linkFacebook.addEventListener("keyup",function(){ linkFacebook.value= mascCaracterEspecial(linkFacebook.value)});
sugestoes_criticas.addEventListener("keyup",function(){ sugestoes_criticas.value= mascCaracterEspecial(sugestoes_criticas.value)});
perguntas.addEventListener("keyup",function(){ perguntas.value= mascCaracterEspecial(perguntas.value)});
txtNome.addEventListener('keyup',mascNome);
txtProficao.addEventListener('keyup',mascProficao);
txtCelular.addEventListener('keyup',mascCelular);
txtTelefone.addEventListener('keyup', mascTelefon);
