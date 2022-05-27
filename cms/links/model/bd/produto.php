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
                (nome, descricao, preco, destaque, desconto, foto, idcategoria)
            values
                ('".$dadosProduto['nome']."',
                 '".$dadosProduto['descricao']."',
                 '".$dadosProduto['preco']."',
                 '".$dadosProduto['destaque']."',
                 '".$dadosProduto['desconto']."',
                 '".$dadosProduto['foto']."',
                 '".$dadosProduto['idcategoria']."' ); ";


    
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

function selectAllProdutos() {
    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblprodutos order by idproduto desc";
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        // mysqli_fetch_assoc() - permite converter os dados do bd em um array para manipulação no PHP
        // nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de o próprio while conseguir gerenciar a qtde de vezes que devera ser feita a repetiçao
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados[$cont] = array (
                "id"         => $rsDados['idproduto'],
                "nome"       => $rsDados['nome'],
                "descricao"   => $rsDados['descricao'],
                "preco"    => $rsDados['preco'],
                "destaque"      => $rsDados['destaque'],
                "desconto"        => $rsDados['desconto'],
                "foto"       => $rsDados['foto']
 
            );
            $cont++;
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        if (isset($arrayDados)) {
            return $arrayDados;
        } else
            return false;

        
    }
}

//Função para deletar no BD
function deleteProduto($id) {

    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão
    $conexao = conexaoMysql();

    //Script para deletar um registro do BD
    $sql = "delete from tblprodutos where idproduto =".$id;
    
    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql))
        //Valida se o BD teve sucesso na execução do excript 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    fecharConexaoMysql($conexao);
    return $statusResposta;

}

function selectByIdProduto($id) {
    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblprodutos where idproduto =".$id;

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        // mysqli_fetch_assoc() - permite converter os dados do bd em um array para manipulação no PHP
        // nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de o próprio while conseguir gerenciar a qtde de vezes que devera ser feita a repetiçao
    
        if ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados = array (
                "id"         => $rsDados['idproduto'],
                "nome"       => $rsDados['nome'],
                "descricao"  => $rsDados['descricao'],
                "preco"      => $rsDados['preco'],
                "destaque"   => $rsDados['destaque'],
                "desconto"   => $rsDados['desconto'],
                "foto"       => $rsDados['foto']

            );
            
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }

}

//Função para realizar o update no BD
function updateProduto($dadosProduto) {
    
    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o BD
    $conexao = conexaoMysql();

    //Monta o script para enviar os dados
    $sql = "update tblprodutos set
                 nome     = '".$dadosProduto['nome']."',
                 descricao = '".$dadosProduto['descricao']."',
                 preco  = '".$dadosProduto['preco']."',
                 desconto    = '".$dadosProduto['desconto']."',
                 destaque      = '".$dadosProduto['destaque']."',
                 foto     = '".$dadosProduto['foto']."'
                
            
            where idproduto =".$dadosProduto['id'];



            
            
            
               
    //Executa o scriipt no BD
    //Validação para verificar se o script esta correto
    if (mysqli_query($conexao, $sql)) {

        //Validação para verificar se uma linha foi acrescentada no BD
        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
       
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    } 
        

}

?>