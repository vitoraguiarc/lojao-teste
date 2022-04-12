<?php
/******************************************************************* 
     * Objetivo: Arquivo responsavel pela manipulação de dados de contato
     * Obs: Este arquivo fara a ponte entre a view e a model
     * Autor: Vitor Aguiar   
     * Data: 25/02/2022
     * Versão: 1.0    
*********************************************************************/

//Função para receber as categorias vindo da view e encaminhar para a model
function inserirCategoria($dadosCategorias) {
    if(!empty($dadosCategorias)) {
        //Validação de campos obrigatorios
        if(!empty($dadosCategorias['txtCategoria'])) {

            //Criação do array de dados que será encaminhado a model
            $arrayDados = array (
                "categoria" => $dadosCategorias['txtCategoria']
            );

            //Require da model
            require_once('model/bd/categoria.php');

            //chamada a função que insere no BD
            if (insertCategoria($arrayDados))
                return true;
            else 
                return array ('idErro'  => 1,
                              'message' => 'Não foi possivel inserir os dados no Banco de Dados');

        } else
            return array ('idErro'  =>  2,
                          'message' =>  'Existem campos obrigatórios que não foram preenchidos');  
    }
}

//Função para atualizar categorias
function atualizarCategoria($dadosCategorias, $id){
    if(!empty($dadosCategorias)){
        //Validação de caixa vazia pois esses elementos são obrigatórios no banco de dados
        if(!empty($dadosCategorias['txtCategoria'])){
            
            //validação para garantir que o id seja valido
            if(!empty($id) && $id != 0 && is_numeric($id)) {

                //Criação do array de dados que será encaminhado a model
                $arrayDados = array (
                    "id"        => $id,
                    "categoria" => $dadosCategorias['txtCategoria']
                );

                //Require do arquivo da model que faz a conexão direta com o BD
                require_once('model/bd/categoria.php');

                //Função que recebe o array e passa ele pro BD
                if (updateCategoria($arrayDados))
                    return true;
                else
                    return array ('idErro' => 1, 
                                  'message' => 'Não foi posivel atualizar os dados no Banco de Dados');
            } else
                return array ('idErro'  => 4,
                              'message' => 'Não é possivel editar uma categoria sem um ID válido ');

        } else
            return array ('idErro'  => 2,
                          'message' => 'Existem campos obrigatórios que não foram preenchidos');
    }
}


//Função para realizar a exclusão de um categoria (Excluir)
function excluirCategoria($id){
    
    //Validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)) {
        
        //Import do arquivo de contato
        require_once('model/bd/categoria.php');

        //Chama a função na model e valida se o retorno foi verdadeiro ou falso
        if(deleteCategoria($id))
            return true;
        else
            return array('idErro' => 3,
                         'message' => 'O banco de dados não pode excluir a categoria.');
    
    } else 
        return array('idErro' => 4,
                         'message' => 'Não é possivel excluir uma categoria sem informar um id válido.');
}

//Função para solicitar os dados da model e encaminhar a lista de categorias p/ view (Listar)
function listarCategoria(){
    //import do arquivo que vai buscar os dados no BD
    require_once('model/bd/categoria.php');

    //chama a função q8e vai buscar os dados no BD
    $dados = selectAllCategorias();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

//Função para buscar uma categoria atraves do id do registro
function buscarCategoria($id) {

    //validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)) {

        //import do arquivo de contato
        require_once('model/bd/categoria.php');

        //chama a função na model que vai buscar no BD
        $dados = selectByIdCategoria($id);

        //valida se existem dados para serem devolvidos
        if(!empty($dados))
            return $dados;
        else
            return false;

    } else {
        return array('idErro' => 4,
                         'message' => 'Não é possivel excluir um registro sem informar um id válido.');
    }
}





?>