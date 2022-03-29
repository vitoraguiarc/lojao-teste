/**/

'use scrict'

let contador = 1
document.getElementById('radio1').checked = true

setInterval( function(){
    passarImagens(); 
}, 3000)

const passarImagens = () =>{
    contador++
    if(contador > 4)
        contador == 1
    
    document.getElementById('radio'+contador).checked = true
    
}

