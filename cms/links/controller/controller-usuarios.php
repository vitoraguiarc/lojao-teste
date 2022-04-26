<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel pela manipulação de dados de contato
     * Obs: Este arquivo fara a ponte entre a view e a model
     * Autor: Vitor Aguiar   
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

//Função para receber os usuarios vindo da view e encaminhar para a model
function inserirUsuario($dadosUsuarios) {
     if(!empty($dadosUsuarios)) {
          //Validação dos campos obrigatorios
          if(!empty($dadosUsuarios['txtNome']) && !empty($dadosUsuarios['txtUsuario']) && !empty($dadosUsuarios['txtEmail']) && !empty($dadosUsuarios['txtSenha'])) {
               
                //Criação do array de dados que será encaminhado a model
                $arrayDados = array (
                       "nome" => $dadosUsuarios['txtNome'],
                       "nomeusuario" => $dadosUsuarios['txtUsuario'],
                       "email" => $dadosUsuarios['txtEmail'],
                       "senha" => $dadosUsuarios['txtSenha']
               );
               
               //require da model
               require_once('model/bd/usuario.php');

               //chamada da função que insere no BD

               if (insertUsuario($arrayDados))
                    return true;
               else 
                    return array ('idErro'  => 1,
                                  'message' => 'Não foi possivel inserir os dados no Banco de Dados');
          
          } else
               return array ('idErro'  =>  2,
                             'message' =>  'Existem campos obrigatórios que não foram preenchidos'); 

     }
}

//Função para solicitar os dados da model e encaminhar a lista de categorias p/ view (Listar)
function listarUsuario(){
     //import do arquivo que vai buscar os dados no BD
     require_once('model/bd/usuario.php');
 
     //chama a função q8e vai buscar os dados no BD
     $dados = selectAllUsuarios();
 
     if (!empty($dados))
         return $dados;
     else
         return false;
}

//Função para realizar a exclusão de um usuario (Excluir)
function excluirUsuario($id){
    
     //Validação para verificar se o id contem um numero valido
     if($id != 0 && !empty($id) && is_numeric($id)) {
         
         //Import do arquivo de contato
         require_once('model/bd/usuario.php');
 
         //Chama a função na model e valida se o retorno foi verdadeiro ou falso
         if(deleteUsuario($id))
             return true;
         else
             return array('idErro' => 3,
                          'message' => 'O banco de dados não pode excluir o usuario.');
     
     } else 
         return array('idErro' => 4,
                          'message' => 'Não é possivel excluir um usuario sem informar um id válido.');
 }

?>