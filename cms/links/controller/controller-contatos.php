<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel pela manipulação de dados de contato
     * Obs: Este arquivo fara a ponte entre a view e a model
     * Autor: Vitor Aguiar   
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

//Função para solicitar os dados da model e encaminhar a lista de mensagens p/ view (Listar)
function listarMensagem(){

    //import do arquivo que vai buscar os dados no BD
    require_once('model/bd/contato.php');

    //chama a função q8e vai buscar os dados no BD
    $dados = selectAllMessages();

    //verificando se não esta vazio
    if (!empty($dados))
        return $dados;
    else
        return false;
}

//Função para realizar a exclusão de um contato (Excluir)
function excluirMessage($id){
        
    //Validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)) {
        
        //Import do arquivo de contato
        require_once('./model/bd/contato.php');

        //Chama a função na model e valida se o retorno foi verdadeiro ou falso
        if(deleteMsg($id))
            return true;
        else
            return array('idErro' => 3,
                         'message' => 'O banco de dados não pode excluir o registro.');
    
    } else 
        return array('idErro' => 4,
                         'message' => 'Não é possivel excluir uma mensagem sem informar um id válido.');
}


?>