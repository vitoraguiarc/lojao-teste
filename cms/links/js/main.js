/******************************************************************* 
     * Objetivo: Arquivo para validar a senha inserida pelo usuario
     * Autor: Vitor Aguiar    
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

// var senha = document.getElementById("senha")
// , confirma_senha = document.getElementById("confirma_senha")

// function validarSenha () {
//     if(senha.value != confirma_senha.value)
//         confirma_senha.setCustomValidity("Senhas diferentes")
//     else    
//         confirma_senha.setCustomValidity('')
// }

// senha.onchange = validarSenha
// confirma_senha.onkeyup = validarSenha

//exibir senha
let btn = document.querySelector('#vizualizar')
let btna = document.querySelector('#vizualizar-b')

function exibirSenha() {
    
    let input = document.querySelector('#senha')
    let inputConfirma = document.querySelector('#confirma_senha')

    if(input.getAttribute('type') == 'password' || inputConfirma.getAttribute('type') == 'password') {
        input.setAttribute('type', 'text')
        inputConfirma.setAttribute('type', 'text')
    }
    else {
        input.setAttribute('type', 'password')
        inputConfirma.setAttribute('type', 'password')
    }
       
        
}

btn.addEventListener('click', exibirSenha)
btna.addEventListener('click', exibirSenha)