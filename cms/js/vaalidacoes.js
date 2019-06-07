function validarCamposUsers(){
    let senha = document.querySelector("#senha");
    let senha2 = document.querySelector("#confirm-sen");
    if(senha.value != senha2.value){
        alert('Sua Confirmação de senha não conhecide!');
        return false;
    }
    return true;
} 

