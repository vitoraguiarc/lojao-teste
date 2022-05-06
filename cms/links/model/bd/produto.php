<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel por manipular os dados dentro do BD (insert, update, select e delete)
     * Autor: Vitor Aguiar    
     * Data: 06/05/2022
     * Versão: 1.0    
*********************************************************************/

//Import da conexao com o BD
require_once('conexao-my-sql.php');

//Função para realizar insert na tblprodutos
function insertProduto($dadosProduto) {

    //Variavel para o return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o banco
    $conexao = conexaoMysql();

    //Script para a inserção de categorias
    $sql = "insert into tblprodutos
                (nome, descricao, preco, destaque, desconto, foto)
            values
                ('".$dadosProduto['nome']."',
                 '".$dadosProduto['descricao']."',
                 '".$dadosProduto['preco']."',
                 '".$dadosProduto['destaque']."',
                 '".$dadosProduto['desconto']."',
                 '".$dadosProduto['foto']."' ); ";


    
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

?>