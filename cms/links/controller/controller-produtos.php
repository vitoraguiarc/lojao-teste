<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel pela manipulação de dados de contato
     * Obs: Este arquivo fara a ponte entre a view e a model
     * Autor: Vitor Aguiar   
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

function inserirProduto($dadosProdutos) {

    $destaque = (int) 0;

    if(!empty($dadosProdutos)) {
        //Validação de campos obrigatorios
        if(!empty($dadosProdutos['txtNome']) || !empty($dadosProdutos['txtDescricao']) || !empty($dadosProdutos['txtPreco']) || !empty($dadosProdutos['txtDesconto']) ) {

            if(isset($_POST['cbkDesconto'])) {
                $destaque = 1;
            } else {
                $destaque = 0;
            }
                

            //Criação do array de dados que será encaminhado a model
            $arrayDados = array (
                "nome"      => $dadosProdutos['txtNome'],
                "descricao" => $dadosProdutos['txtDescricao'],
                "preco"     => $dadosProdutos['txtPreco'],
                "desconto"  => $dadosProdutos['txtDesconto'],
                "destaque"  => $destaque
                
            );

            //Require da model
            require_once('model/bd/produto.php');

            //chamada a função que insere no BD
            if (insertProduto($arrayDados))
                return true;
            else 
                return array ('idErro'  => 1,
                              'message' => 'Não foi possivel inserir os dados no Banco de Dados');

        } else
            return array ('idErro'  =>  2,
                          'message' =>  'Existem campos obrigatórios que não foram preenchidos');  
    }
}






?>