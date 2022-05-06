<?php

/******************************************************************* 
     * Objetivo: Arquivo responsavel por manipular os dados dentro do BD (insert, update, select e delete)
     * Autor: Vitor Aguiar    
     * Data: 11/03/2022
     * Versão: 1.0    
*********************************************************************/

//Import da conexao com o BD
require_once('conexao-my-sql.php');

//Função para realizar insert na tblUsuarios
function insertUsuario($dadosUsuario) {

    //Variavel para o return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o banco
    $conexao = conexaoMysql();

    //Script para a inserção de categorias
    $sql = "insert into tblusuarios
                (nome, nomeusuario, email, senha)
            values
                ('".$dadosUsuario['nome']."',
                 '".$dadosUsuario['usuario']."',
                 '".$dadosUsuario['email']."',
                 '".$dadosUsuario['senha']."'); ";


    
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
function updateUsuario($dadosUsuario) {
    
    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o BD
    $conexao = conexaoMysql();

    //Monta o script para enviar os dados
    $sql = "update tblusuarios set
                 nome        = '".$dadosUsuario['nome']."',
                 nomeusuario = '".$dadosUsuario['usuario']."',
                 email       =  '".$dadosUsuario['email']."',
                 senha       = '".$dadosUsuario['senha']."'
                 
            where idusuario =".$dadosUsuario['id'];
            
               
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
function deleteUsuario($id) {

    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão
    $conexao = conexaoMysql();

    //Script para deletar um registro do BD
    $sql = "delete from tblusuarios where idusuario =".$id;
    
    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql))
        //Valida se o BD teve sucesso na execução do excript 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    //Solicita o fechamento da conexão com o BD
    fecharConexaoMysql($conexao);

    return $statusResposta;

}

//Função para listar todos os usuarios no BD
function selectAllUsuarios() {
    
    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblusuarios order by idusuario desc";
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados[$cont] = array (
                "id"          => $rsDados['idusuario'],
                "nome"        => $rsDados['nome'],
                "nomeusuario" => $rsDados['nomeusuario'],
                "email"       => $rsDados['email'],
                "senha"       => $rsDados['senha']
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

//Função para buscar um usuario no BD atraves do ID
function selectByIdUsuario($id) {

    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tblusuarios where idusuario =".$id;

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        if ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados = array (
                "id"         => $rsDados['idusuario'],
                "nome"       => $rsDados['nome'],
                "nomeusuario"       => $rsDados['nomeusuario'],
                "email"       => $rsDados['email'],
                "senha"       => $rsDados['senha']
            );
            
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }

}



?>