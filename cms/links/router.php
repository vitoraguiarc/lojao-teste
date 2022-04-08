<?php

/****************************************************************************
    * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View 
    * (dados de um form, listagem de dados, ação de excluir ou atualizar). Esse
    * arquivo será responsável por encaminhar as solicitações para a Controller
    * Autor: Vitor Aguiar
    * Data: 04/03/2022
    * Versão: 1.0
*****************************************************************************/
$action = (string) null;
$component = (string) null;

//validação para verificar se a requisição é um POST de formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {

    //Recebendo dados via URL p/ saber quem tá solicitando e qual ação será realizada
    $component =  strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);


    //Estrutura condicional para validar quem esta solicitando algo para o maestro
    switch($component)
    {
        case 'CONTATOS';

            //Importar o arquivo da controller
            require_once('controller/controller-contatos.php');

            //Validação para qual ação será realizada
             if ($action == 'DELETAR') {
                //Recebe o id do registro que devera ser excluído, este foi enviado pela url no link da imagem do excluir que foi acionado na index
                $idContato = $_GET['id']; 
                
                $resposta = excluirMessage($idContato);

                if(is_bool($resposta)) 
                    echo("<script>
                            alert('Mensagem excluída com sucesso!!');
                            window.location.href = 'contatos.php';
                        </script>");
                 elseif (is_array($resposta))
                    echo("<script>
                            alert('".$resposta['message']."');
                            window.history.back();
                        </script>"); 
                
            } 
            
        break;

    }
}


?>