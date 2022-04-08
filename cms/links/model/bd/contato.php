<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel por manipular os dados dentro do BD (insert, update, select e delete)
     * Autor: Vitor Aguiar    
     * Data: 11/03/2022
     * Versão: 1.0    
*********************************************************************/

//Import do arquivo que estabelece a conexão com o BD
require_once('conexao-my-sql.php');

//Função para listar todas as mensagens no BD
function selectAllMessages() {
    
    //Abre a conexão
    $conexao = conexaoMysql();
    
    //Script ordenando by id e de forma decrescente
    $sql = "select * from tblcontatos order by idcontato desc";

    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        // mysqli_fetch_assoc() - permite converter os dados do bd em um array para manipulação no PHP
        // nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de o próprio while conseguir gerenciar a qtde de vezes que devera ser feita a repetiçao
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados[$cont] = array (
                "id"         => $rsDados['idcontato'],
                "nome"       => $rsDados['nome'],
                "celular"    => $rsDados['celular'],
                "email"      => $rsDados['email'],
                "msg"        => $rsDados['msg']
            );
            $cont++;
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        //Retorno array de dados
        return $arrayDados;
    }

   
}

//Função para deletar no BD
function deleteMsg($id) {

    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão
    $conexao = conexaoMysql();

    //Script para deletar um registro do BD
    $sql = "delete from tblcontatos where idcontato =".$id;
    
    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql))
        //Valida se o BD teve sucesso na execução do excript 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    fecharConexaoMysql($conexao);
    return $statusResposta;

}



?>