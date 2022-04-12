<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel por manipular os dados dentro do BD (insert, update, select e delete)
     * Autor: Vitor Aguiar    
     * Data: 11/03/2022
     * Versão: 1.0    
*********************************************************************/
//Import da conexao com o BD
require_once('conexao-my-sql.php');

//Função para realizar insert na tblCategorias
function insertCategoria($dadosCategoria) {

    //Variavel para o return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o banco
    $conexao = conexaoMysql();

    //Script para a inserção de categorias
    $sql = "insert into tblcategorias
                (categoria)
            values
                ('".$dadosCategoria['categoria']."'); ";

    
    //Executa o script no BD
    //Validação para verificar se o script esta correto
    if (mysqli_query($conexao, $sql)) {

        //Validação para verificar se uma linha foi acrescentada no BD
        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $statusResposta;
    } 

}


//Função para realizar o update no BD
function updateCategoria($dadosCategoria) {
    
    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o BD
    $conexao = conexaoMysql();

    //Monta o script para enviar os dados
    $sql = "update tblcategorias set
                 categoria = '".$dadosCategoria['categoria']."'
                 
            where idcategoria =".$dadosCategoria['id'];
            
               
    //Executa o script no BD
    //Validação para verificar se o script esta correto
    if (mysqli_query($conexao, $sql)) {

        //Validação para verificar se uma linha foi acrescentada no BD
        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
        
        //Fecha conexão com o BD
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    } 
        

}

//Função para deletar no BD
function deleteCategoria($id) {

    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão
    $conexao = conexaoMysql();

    //Script para deletar um registro do BD
    $sql = "delete from tblcategorias where idcategoria =".$id;
    
    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql))
        //Valida se o BD teve sucesso na execução do excript 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    //Solicita o fechamento da conexão com o BD
    fecharConexaoMysql($conexao);

    return $statusResposta;

}

//Função para listar todos as categorias no BD
function selectAllCategorias() {
    
    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblcategorias order by idcategoria desc";
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados[$cont] = array (
                "id"         => $rsDados['idcategoria'],
                "categoria"       => $rsDados['categoria']
            );
            $cont++;
        }
    }

    
    //Solicita o fechamento da conexão com o BD
    fecharConexaoMysql($conexao);
    if(isset($arrayDados)) {
        return $arrayDados;
    } else
        return false;
    
}

//Função para buscar um contato no BD atraves do ID
function selectByIdCategoria($id) {

    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblcategorias where idcategoria =".$id;

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        if ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados = array (
                "id"         => $rsDados['idcategoria'],
                "categoria"       => $rsDados['categoria']
            );
            
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }

}




?>